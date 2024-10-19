<?php

namespace App\Http\Services\User;


use App\Models\User;
use App\Models\Transaction;
use App\Models\Shop;
use Exception;
use App\Models\Setting;

class UpdateBalance
{
    public function index($request)
    {
        $user = $request->user();
        if ($user->last_give_spins->diffInHours(now()) > 24) {
            $user->last_give_spins = now();
            $user->free_spins = 2;
            $user->save();
        }
        $setting = Setting::query()->first();
        $transactions = $this->getTransactions($setting->address_ton);
        $transactions = array_map(function ($transaction) use ($user) {
            return [
                'user_id' => $user['text'],
                'amount' => $transaction['amount'],
                'hash' => $transaction['hash'],
                'shop_id' => $transaction['shop_id']
            ];
        }, $transactions);
        foreach ($transactions as $transaction) {
            if (Transaction::where('hash', $transaction['hash'])->exists()) {
                continue;
            }
            Transaction::create($transaction);
            if ($user->autoclaim_bonus === false && $transaction['amount'] == $setting->price_autoclaim) {
                $user->autoclaim_bonus = true;
                $user->save();
                return response()->json(['message' => 'Autoclaim bonus claimed']);
            }
            $shop = Shop::where('amount', $transaction['amount'])->first();
            $user->balance_donat += $shop->amount;
            $user->save();
        }
        return response()->json(['message' => 'Balance updated']);
    }

    public function getTransactions($token)
    {
        $url = "https://tonapi.io/v2/blockchain/accounts/{$token}/transactions?limit=100";

        try {
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            $transactions = array_filter($data['transactions'], function ($transaction) {
                return isset($transaction['in_msg']);
            });

            $result = array_map(function ($transaction) {
                return [
                    'amount' => $this->toNumber($transaction['in_msg']['value']),
                    'text' => $transaction['in_msg']['decoded_body']['text'] ?? null,
                    'hash' => $transaction['hash']
                ];
            }, $transactions);

            return array_filter($result, function ($transaction) {
                return $transaction['amount'] > 0.049;
            });
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    private function toNumber($value)
    {
        return floatval($value);
    }
}
