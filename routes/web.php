<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\ProductController;

// Grup rute dengan prefix 'products'
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

