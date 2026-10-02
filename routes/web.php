<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\InventoryMovementController;
use Illuminate\Support\Facades\Route;



Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::get('products/{product}/pdf', [ProductController::class, 'generatePDF'])
    ->name('products.pdf');

Route::resource('products', ProductController::class)
    ->except(['index']);

Route::resource('providers', ProviderController::class);

Route::get('/movements', [InventoryMovementController::class, 'view'])
    ->name('movements.index');


