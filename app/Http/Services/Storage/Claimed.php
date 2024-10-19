<?php

namespace App\Http\Services\Storage;

use App\Http\Services\dataLvl;
use App\Models\Maning;
use App\Models\Storage;
use App\Models\User;

class Claimed
{
    public function index($request)
    {
        $lvlRecharging = dataLvl::$lvlRecharging;
        $user = $request->user();
        $storage = Storage::query()->where('user_id', $user->id)->where('collected', 0)->first();
        $count = Storage::query()->where('user_id', $user->id)->count();
        if($storage){
            $storage->collected = 1;
            $user->balance += $storage->energy / 100;
            $storage->save();
            $user->save();
            $energy_max = $lvlRecharging[$user->recharging_level]['energy'];
            Storage::query()->create([
                'user_id' => $user->id,
                'energy_max' => $energy_max
            ]);
            $storage = Storage::query()->where('user_id', $user->id)->where('collected', 0)->first();
            if($user->ref_id){
                $ref = User::query()->where('id', $user->ref_id)->first();
                $ref->balance += ($storage->energy / 100) * 0.25;
                $ref->save();
            }
            return response()->json(['success' => true, 'storage' => $storage, 'user' => $user]);

        }

        return response()->json(['success' => false, 'error' => 'no_active_storage', 'message' => 'No active storage', 'count' => $count]);
    }
}
