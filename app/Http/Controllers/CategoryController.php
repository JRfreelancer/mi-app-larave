<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        $category->load('products');

        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return response()->json([
                'mensaje' => 'Categoría eliminada correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'No se pudo eliminar la categoría'
            ], 500);
        }
    }
}
