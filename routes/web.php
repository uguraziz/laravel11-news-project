<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::get('info', function () {
    return view('info');
});

Route::get('test', [TestController::class, 'test_metodu']);

Route::prefix('user')->withoutMiddleware(VerifyCsrfToken::class)
->group(function () {
    Route::post('create', [UserController::class, 'create_user']);
    Route::get('get', [UserController::class, 'get_user']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::prefix('get')->group(function () {
        Route::get('{user_id}', [UserController::class, 'get_user_from_id']);
    });
});


Route::prefix('category')->withoutMiddleware(VerifyCsrfToken::class)
->group(function () {
    Route::get('get', [CategoriesController::class, 'get_categories']);
    Route::post('update', [CategoriesController::class, 'update_category']);
    Route::post('delete', [CategoriesController::class, 'delete_category']);
});
