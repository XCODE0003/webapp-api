<?php

namespace App\Http\Services\User;

class BuyBoost
{

    public function index($request)
    {
        $type_boost = $request->input('type_boost');
        $user = auth()->user();
        $dataLvl = new \App\Http\Services\dataLvl();
        $lvlRecharging = $dataLvl::$lvlRecharging;
        $lvlAutobot = $dataLvl::$autoBot;
        $lvlTap = $dataLvl::$tapLvl;

        if ($type_boost == 'lvlTap') {
            $max_lvl = $lvlTap[count($lvlTap) - 1];

            if ($user->click_level >= $max_lvl) {
                return response()->json([
                    'success' => false,
                    'error' => 'You have already reached the maximum level for this boost.'
                ]);
            }
            if ($user->balance < $lvlTap[$user->click_level + 1]['cost']) {
                return response()->json([
                    'success' => false,
                    'error' => 'You do not have enough balance to buy this boost.'
                ]);
            }

            $user->balance -= $lvlTap[$user->click_level + 1]['cost'];
            $user->click_level += 1;
            $user->save();
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }
        if ($type_boost == 'lvlAutobot') {
            $max_lvl = $lvlAutobot[count($lvlAutobot) - 1];
            if ($user->autobot_level >= $max_lvl) {
                return response()->json([
                    'success' => false,
                    'error' => 'You have already reached the maximum level for this boost.'
                ]);
            }
            if ($user->balance < $lvlAutobot[$user->autobot_level + 1]['cost']) {
                return response()->json([
                    'success' => false,
                    'error' => 'You do not have enough balance to buy this boost.'
                ]);
            }
            $user->balance -= $lvlAutobot[$user->autobot_level + 1]['cost'];
            $user->autobot_level += 1;
            $user->save();
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }
        if ($type_boost == 'lvlRecharging') {
            $max_lvl = $lvlRecharging[count($lvlRecharging) - 1];
            if ($user->recharging_level >= $max_lvl) {
                return response()->json([
                    'success' => false,
                    'error' => 'You have already reached the maximum level for this boost.'
                ]);
            }
            if ($user->balance < $lvlRecharging[$user->recharging_level + 1]['cost']) {
                return response()->json([
                    'success' => false,
                    'error' => 'You do not have enough balance to buy this boost.'
                ]);
            }
            $user->balance -= $lvlRecharging[$user->recharging_level + 1]['cost'];
            $user->recharging_level += 1;
            $user->save();
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }
    }
}
