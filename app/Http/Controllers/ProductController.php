<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Mostrar todos los productos.
     */
    public function index(Request $request)
    {
        $products = Product::with(['category', 'provider'])->paginate(10);

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

        return view('products.edit', compact('product', 'categories', 'providers'));
    }

    /**
     * Crear un nuevo producto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
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
            'image' => $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null,
        ]);

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {
            $product->load(['category', 'provider']);
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
        $product->load(['category', 'provider']);

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $oldImage = $product->image;

        if ($request->hasFile('image')) {
            // Guardamos la imagen nueva
            $newImage = $request->file('image')->store('products', 'public');

            // Indicamos que el producto debe usar la nueva imagen
            $validated['image'] = $newImage;
        }

        $product->update($validated);

        if ($request->hasFile('image')) {
            // Eliminamos la imagen anterior después de actualizar el producto
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        // Recargamos relaciones para asegurar que la respuesta API incluya datos actualizados
        $product->load(['category', 'provider']);

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
            // Eliminamos la imagen asociada al producto antes de borrarlo
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

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
                ->with('error', 'No se pudo eliminar el producto.');
        }
    }

    public function generatePDF(Product $product)
    {
        $product->load(['category', 'provider']);
        $pdf = Pdf::loadView('products.pdf', compact('product'));
        return $pdf->stream('producto_' . $product->id . '.pdf');
    }
}
