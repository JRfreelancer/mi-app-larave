<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Total de unidades disponibles.
        $stockTotal = Product::sum('quantity');

        // Clasificación de productos por existencias.
        $stockBajo = Product::whereBetween('quantity', [0, 9])->count();

        $stockMedio = Product::whereBetween('quantity', [10, 20])->count();

        $stockNormal = Product::where('quantity', '>', 20)->count();

        // Productos con existencias inferiores a 10 unidades.
        $productosCriticos = Product::query()
            ->where('quantity', '<', 10)
            ->orderBy('quantity', 'asc')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'quantity']);

        // Enviar todos los datos a la vista.
        return view('dashboard.index', compact(
            'stockTotal',
            'stockBajo',
            'stockMedio',
            'stockNormal',
            'productosCriticos'
        ));
    }
}
