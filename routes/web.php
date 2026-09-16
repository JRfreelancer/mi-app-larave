<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::resource('products', ProductController::class)
    ->except(['index']);

Route::resource('providers', ProviderController::class);
