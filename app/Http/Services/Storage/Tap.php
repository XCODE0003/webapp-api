<?php

namespace App\Http\Services\Storage;

use App\Http\Services\dataLvl;
use App\Models\Maning;
use App\Models\Storage;
use DateInterval;
use DateTime;

class Tap
{
    /**
     * @throws \Exception
     */
    public function index($request)
    {
        $lvlTap = dataLvl::$tapLvl;
        $user = $request->user();
        $storage = Storage::query()->where('user_id', $user->id)->where('collected', 0)->first();
        $count = Storage::query()->where('user_id', $user->id)->count();
        if($storage){
            if($storage->energy >= $storage->energy_max){
                $storage->energy = $storage->energy_max;
                $storage->save();
                return response()->json(['success' => false, 'error' => 'storage_full', 'message' => 'Storage full'], 400);
            }
            $storage->energy += 5 * $lvlTap[$user->click_level]['multiplier'];
            $storage->energy_tap += 1;
            $storage->save();
            return response()->json(['success' => true, 'storage' => $storage]);
        }
        return response()->json(['success' => false, 'error' => 'no_active_manning', 'message' => 'No active manning', 'count' => $count]);
    }
}
