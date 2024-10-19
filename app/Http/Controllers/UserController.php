<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\Storage\Tap;
use App\Http\Services\User\SetFriend;
use Illuminate\Http\Request;


use App\Http\Services\User\Get;

class UserController extends Controller
{
    public function bot(UserRequest $request)
    {
        return (new Get())->bot($request);
    }
    public function index(Request $request)
    {
        return (new Get())->index($request);
    }
    public function tap(Request $request)
    {
        return (new Tap())->index($request);
    }

    public function manningActive(Request $request)
    {
        return (new \App\Http\Services\Storage\GetActive())->index($request);
    }

    public function manningStart(Request $request)
    {
        return (new \App\Http\Services\Storage\Start())->index($request);
    }

    public function bonusClaim(Request $request)
    {
        return (new \App\Http\Services\Storage\Claimed())->index($request);
    }

    public function referralSet(Request $request)
    {
        $id_user = $request->input('friend');
        return (new SetFriend())->index($id_user);
    }
    public function buyBoost(Request $request)
    {
        return (new \App\Http\Services\User\BuyBoost())->index($request);
    }
    public function referrals(Request $request)
    {
        return (new \App\Http\Services\User\GetReferrals())->index($request);
    }

    public function getShop(Request $request)
    {
        return (new \App\Http\Services\User\GetShop())->index($request);
    }
    public function spin(Request $request)
    {
        return (new \App\Http\Services\Casino\Spin())->index($request);
    }

    public function transactionCheck(Request $request)
    {
        return (new \App\Http\Services\User\UpdateBalance())->index($request);
    }
    public function settingsGet(Request $request)
    {
        return (new \App\Http\Services\User\GetSettings())->index($request);
    }
}
