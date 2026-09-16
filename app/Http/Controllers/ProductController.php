<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Mostrar todos los productos.
     */
    public function index(Request $request)
    {
        $products = Product::with([
            'category',
            'provider'
        ])->paginate(10);

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {
            return response()->json($products);
        }

        // Si la petición viene de la interfaz web, mostramos el inventario.
        return view('welcome', compact('products'));
    }

    /**
     * Mostrar el formulario para crear un producto.
     */
    public function create()
    {
        $categories = Category::all();
        $providers = Provider::all();

        return view('products.create', compact('categories', 'providers'));
    }

    /**
     * Mostrar el formulario para editar un producto.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $providers = Provider::all();

        return view('products.edit', compact(
            'product',
            'categories',
            'providers'
        ));
    }

    /**
     * Crear un nuevo producto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'provider_id' => $request->provider_id,
        ]);

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {

            $product->load([
                'category',
                'provider'
            ]);

            return response()->json($product, 201);
        }

        // Si viene del formulario web, volvemos al inventario.
        return redirect()
            ->route('home')
            ->with('success', 'Producto creado correctamente.');
    }
    /**
     * Mostrar un producto específico.
     */
    public function show(Request $request, Product $product)
    {
        $product->load([
            'category',
            'provider'
        ]);

        if ($request->is('api/*')) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Actualizar un producto.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $product->update($validated);

        $product->load([
            'category',
            'provider'
        ]);

        if ($request->is('api/*')) {
            return response()->json($product);
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar un producto.
     */
    public function destroy(Request $request, Product $product)
    {
        try {
            $product->delete();

            if ($request->is('api/*')) {
                return response()->json([
                    'mensaje' => 'Producto eliminado correctamente'
                ], 200);
            }

            return redirect()
                ->route('home')
                ->with('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {

            if ($request->is('api/*')) {
                return response()->json([
                    'mensaje' => 'No se pudo eliminar el producto'
                ], 500);
            }

            return redirect()
                ->route('home')
                ->with('success', 'No se pudo eliminar el producto.');
        }
    }
}
