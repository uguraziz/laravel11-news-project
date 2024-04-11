<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::get('info', function () {
    return view('info');
});

Route::get('test', [TestController::class, 'test_metodu']);

Route::prefix('user')->group(function () {
    Route::post('create', [UserController::class, 'create_user']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::prefix('get')->group(function () {
        Route::get('{user_id}', [UserController::class, 'get_user_from_id']);
    });
});
