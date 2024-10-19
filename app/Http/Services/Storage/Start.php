<?php

namespace App\Http\Services\Storage;

use App\Models\Maning;
use App\Http\Services\dataLvl;
use App\Models\Storage;

class Start
{
    public function index($request)
    {
        $user = $request->user();
        $storage = Storage::query()->where('user_id', $user->id)->where('collected', 0)->first();
        if($storage){
            return response()->json(['success' => false, 'error' => 'storage_not_empty', 'message' => 'Storage not empty']);
        }

        $energy_max = dataLvl::$lvlRecharging[$user->recharging_level]['energy'];
        $storage = Storage::query()->create([
            'user_id' => $user->id,
            'energy_max' => $energy_max
        ]);



        return response()->json(['success' => true, 'storage' => $storage]);
    }
}
