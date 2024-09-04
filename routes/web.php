<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\ProductController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])
    ->group(function () {
        Route::resource('products', ProductController::class);
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });

Auth::routes();