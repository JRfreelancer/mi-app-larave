<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Mostrar todos los proveedores.
     */
    public function index(Request $request)
    {
        $providers = Provider::all();

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {
            return response()->json($providers);
        }

        // Si viene de la interfaz web, mostramos la vista.
        return view('providers.index', compact('providers'));
    }

    /**
     * Mostrar el formulario para crear un proveedor.
     */
    public function create()
    {
        return view('providers.create');
    }

    /**
     * Guardar un nuevo proveedor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'contact' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:150',
            'address' => 'nullable|string|max:200',
        ]);

        $provider = Provider::create($validated);

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {
            return response()->json($provider, 201);
        }

        return redirect()
            ->route('providers.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    /**
     * Mostrar un proveedor específico.
     */
    public function show(Request $request, Provider $provider)
    {
        $provider->load('products');

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {
            return response()->json($provider);
        }

        return view('providers.show', compact('provider'));
    }

    /**
     * Mostrar el formulario para editar un proveedor.
     */
    public function edit(Provider $provider)
    {
        return view('providers.edit', compact('provider'));
    }

    /**
     * Actualizar un proveedor.
     */
    public function update(Request $request, Provider $provider)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'contact' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:150',
            'address' => 'nullable|string|max:200',
        ]);

        $provider->update($validated);

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {
            return response()->json($provider);
        }

        return redirect()
            ->route('providers.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Eliminar un proveedor.
     */
    public function destroy(Request $request, Provider $provider)
    {
        $provider->delete();

        // Si la petición viene de la API, devolvemos JSON.
        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Proveedor eliminado correctamente.'
            ]);
        }

        return redirect()
            ->route('providers.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}
