<?php

namespace App\Http\Services\User;

use App\Models\User;

class Get
{
    public function index($request)
    {
        $user = $request->user();
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function bot($request)
    {
        $user = User::query()->find($request->id);
        if (!$user) return (new CreateUser())->index($request);
        $user = User::query()->find($request->id);
        $user->token = $user->createToken('token')->plainTextToken;
        return response()->json(['success' => true, 'user' => $user]);
    }
}
