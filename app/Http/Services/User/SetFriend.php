<?php

namespace App\Http\Services\User;

use Illuminate\Support\Facades\Auth;

class SetFriend
{
    public function index($user_id)
    {
        $user = Auth::user();
        if($user->id === $user_id){
            return response()->json(['success' => false ,'message' => 'You can not set yourself as a referral']);
        }
        $user->ref_id = $user_id;
        $user->save();
        return response()->json(['success' => true ,'message' => 'Referral set successfully']);
    }
}
