<?php

namespace App\Http\Services\Casino;

use Illuminate\Support\Facades\Auth;

class Spin
{
    public function index($request)
    {

        $user = Auth::user();
        $win = $request->win;

        if ($user->free_spins > 0) {
            $user->free_spins--;
        } elseif ($user->balance_donat >= 300) {
            $user->balance_donat -= 300;
        } else {
            return response()->json(['success' => false, 'error' => 'not_enough_balance', 'message' => 'Not enough balance to spin']);
        }

        $user->balance += ($win == 'jackpot') ? $this->getJackpotAmount() : $win;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Spin completed successfully']);
    }

    private function getJackpotAmount()
    {
        $random = mt_rand(1, 100);

        if ($random <= 10) {
            return 1000000000; // 10% шанс
        } elseif ($random <= 20) {
            return 50000000;   // 20% шанс
        } elseif ($random <= 40) {
            return 10000000;   // 40% шанс
        } else {
            return 1000000;    // 80% шанс
        }
    }
}
