<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::get('lvl', [\App\Http\Controllers\OtherController::class, 'getLvl'])->middleware('auth:sanctum');
Route::get('news', [\App\Http\Controllers\OtherController::class, 'news'])->middleware('auth:sanctum');
Route::prefix('user')->group(function () {
    Route::prefix('bot')->group(function () {
        Route::get('get', [UserController::class, 'bot']);
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('get', [UserController::class, 'index']);
        Route::get('storage/active', [UserController::class, 'manningActive']);
        Route::get('referrals', [UserController::class, 'referrals']);
        Route::post('storage/start', [UserController::class, 'manningStart']);
        Route::post('bonus/claim', [UserController::class, 'bonusClaim']);
        Route::post('tap', [UserController::class, 'tap']);
        Route::post('boost/buy', [UserController::class, 'buyBoost']);
        Route::post('bot/referral/set', [UserController::class, 'referralSet']);
        Route::get('shop/get', [UserController::class, 'getShop']);
        Route::post('casino/spin', [UserController::class, 'spin']);


        Route::get('transactions/check', [UserController::class, 'transactionCheck']);
        Route::get('settings/get', [UserController::class, 'settingsGet']);
    });
});
