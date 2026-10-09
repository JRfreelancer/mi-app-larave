<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Página principal: Dashboard.
Route::get('/', [DashboardController::class, 'index'])
    ->name('home');

// Listado de productos.
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// Generación del PDF de un producto.
Route::get('products/{product}/pdf', [ProductController::class, 'generatePDF'])
    ->name('products.pdf');

// Resto de operaciones de productos.
Route::resource('products', ProductController::class)
    ->except(['index']);

// Proveedores.
Route::resource('providers', ProviderController::class);

// Movimientos de inventario.
Route::get('/movements', [InventoryMovementController::class, 'view'])
    ->name('movements.index');

Route::get('/movements/{movement}/pdf', [InventoryMovementController::class, 'generatePDF'])
    ->name('movements.pdf');

Route::get('/movements/report/pdf', [InventoryMovementController::class, 'generateGeneralPDF'])
    ->name('movements.report.pdf');

// Acceso al Dashboard.
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
