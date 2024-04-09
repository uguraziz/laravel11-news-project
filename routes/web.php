<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('info', function () {
    return view('info');
});

Route::get('test', [TestController::class, 'test_metodu']);

