<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\StockProduct;
use Illuminate\Support\Facades\Notification;

class InventoryMovementController extends Controller
{
    /**
     * API: listar movimientos.
     */
    public function index()
    {
        $movements = InventoryMovement::with('product')
            ->latest()
            ->get();

        return response()->json($movements);
    }

    /**
     * Vista web de movimientos.
     */
public function view()
{
    $products = Product::orderBy('name')->get();

    $movements = InventoryMovement::with('product')
        ->latest()
        ->get();

    $lowStockLimit = config('inventory.low_stock_limit');

    $lowStockProducts = Product::where('quantity', '<', $lowStockLimit)
        ->orderBy('quantity', 'asc')
        ->get();

    return view('movements.index', compact(
        'products',
        'movements',
        'lowStockProducts'
    ));
}

    /**
     * API: registrar entrada o salida.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:entrada,salida'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reason' => ['nullable', 'string', 'max:255'],
            'observation' => ['nullable', 'string'],
        ]);

        $movement = DB::transaction(function () use ($validated) {

            $product = Product::lockForUpdate()
                ->findOrFail($validated['product_id']);

            // Cantidad antes del movimiento
            $previousQuantity = $product->quantity;

            // Límite de stock bajo
            $lowStockLimit = config('inventory.low_stock_limit');

            // Validar que no salga más de lo disponible
            if (
                $validated['type'] === 'salida' &&
                $validated['quantity'] > $product->quantity
            ) {
                abort(
                    422,
                    'No hay suficiente inventario disponible para realizar esta salida.'
                );
            }

            // Actualizar inventario
            if ($validated['type'] === 'entrada') {
                $product->quantity += $validated['quantity'];
            } else {
                $product->quantity -= $validated['quantity'];
            }

            $product->save();

            // Registrar movimiento
            $movement = InventoryMovement::create($validated);

            /*
        |--------------------------------------------------------------------------
        | ALERTA DE STOCK BAJO
        |--------------------------------------------------------------------------
        |
        | El correo se envía solamente cuando el producto
        | cruza el límite de stock bajo.
        |
        */

            if (
                $previousQuantity >= $lowStockLimit &&
                $product->quantity < $lowStockLimit
            ) {
                Notification::route(
                    'mail',
                    config('inventory.stock_alert_email')
                )->notify(
                    new StockProduct($product)
                );
            }

            return $movement;
        });

        return response()->json([
            'message' => 'Movimiento registrado correctamente.',
            'movement' => $movement->load('product'),
        ], 201);
    }
}
