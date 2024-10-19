<?php

namespace App\Http\Services\User;


use App\Models\Setting;
use Exception;

class GetSettings
{
    public function index($request)
    {
        $setting = Setting::query()->first();
        return response()->json(['settings' => $setting]);
    }
}
