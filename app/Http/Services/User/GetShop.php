<?php

namespace App\Http\Services\User;

use App\Models\Shop;

class GetShop
{

    public function index($request)
    {
        $shop = Shop::all();
        return response()->json([
            'success' => true,
            'shop' => $shop
        ]);
    }
}
