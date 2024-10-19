<?php

namespace App\Http\Services\Storage;

use App\Http\Services\dataLvl;
use App\Models\Maning;
use App\Models\Storage;

class GetActive
{
    /**
     * @throws \Exception
     */
    public function index($request)
    {
        $lvlRecharging = dataLvl::$lvlRecharging;
        $lvlTap = dataLvl::$tapLvl;
        $user = $request->user();
        $storage = Storage::query()->where('user_id', $user->id)->where('collected', 0)->first();
        if (!$storage) {
            $storage = Storage::query()->create([
                'user_id' => $user->id,
                'energy_max' => $lvlRecharging[$user->recharging_level]['energy']
            ]);
        }

        $secondsPassed = (new \DateTime())->getTimestamp() - (new \DateTime($storage->created_at))->getTimestamp();
        $storage->energy =  (((5 * $lvlTap[$user->click_level]['multiplier']) * $storage->energy_tap) + $secondsPassed);
        if ($storage->energy >= $storage->energy_max) {
            $storage->energy = $storage->energy_max;
        }
        $storage->save();

        return response()->json(['success' => true, 'storage' => $storage]);
    }
}
