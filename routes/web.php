<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MainCategoriesController;
use App\Http\Controllers\NewsController;
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
    Route::get('get/{id?}', [CategoriesController::class, 'get_categories']);
    Route::post('create', [CategoriesController::class, 'create_category']);
    Route::post('update/{id}', [CategoriesController::class, 'update_category']);
    Route::post('delete/{id}', [CategoriesController::class, 'delete_category']);
});

Route::prefix('main-category')->withoutMiddleware(VerifyCsrfToken::class)
->group(function () {
    Route::get('get/{id?}', [MainCategoriesController::class, 'get_main_categories']);
    Route::post('create', [MainCategoriesController::class, 'create_main_category']);
    Route::post('update/{id}', [MainCategoriesController::class, 'update_main_category']);
    Route::post('delete/{id}', [MainCategoriesController::class, 'delete_main_category']);
});

Route::prefix('news')->withoutMiddleware(VerifyCsrfToken::class)
->group(function () {
    Route::get('get/{id?}', [NewsController::class, 'get_news']);
    Route::post('create', [NewsController::class, 'create_news']);
    Route::post('update/{id}', [NewsController::class, 'update_news']);
    Route::post('delete/{id}', [NewsController::class, 'delete_news']);
});
