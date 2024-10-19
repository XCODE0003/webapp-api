<?php

namespace App\Http\Services\User;

use App\Models\User;

class GetReferrals
{

    public function index($request)
    {
        $user = $request->user();
        $referrals = User::query()->select('avatar', 'firstName', 'id')->where('ref_id', $user->id)->get();
        return response()->json(['success' => true, 'referrals' => $referrals]);
    }
}
