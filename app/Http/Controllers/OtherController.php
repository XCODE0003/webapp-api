<?php

namespace App\Http\Controllers;

use App\Http\Services\dataLvl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    public function getLvl()
    {
        $user = Auth::user();
        $lvlRecharging = dataLvl::$lvlRecharging;
        $lvlTap = dataLvl::$tapLvl;
        $lvlAutobot = dataLvl::$autoBot;
        $lvlRecharging[$user->recharging_level + 1]['user_lvl'] = true;
        $lvlTap[$user->click_level + 1]['user_lvl'] = true;
        $lvlAutobot[$user->autobot_level + 1]['user_lvl'] = true;
        return response()->json(['lvlRecharging' => $lvlRecharging, 'lvlTap' => $lvlTap, 'lvlAutobot' => $lvlAutobot]);
    }
    public function news()
    {
        return response()->json(['news' => \App\Models\News::all()]);
    }
}
