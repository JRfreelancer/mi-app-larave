@extends('layouts.app')

@section('title', 'Inicio | Inventrario API App')

@section('content')

    <div class="container py-5">

        {{-- Encabezado --}}
        <div class="row mb-4">

            <div class="col-12">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <div>

                        <h1 class="fw-bold mb-1">
                            Inventario
                        </h1>

                        <p class="text-secondary mb-0">
                            Administración de productos y existencias
                        </p>

                    </div>

                    <div>
                        <a href="{{ route('products.create') }}" class="btn btn-gray">
                            <i class="bi bi-plus-lg me-1"></i>
                            Nuevo producto
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar">
                </button>

            </div>
        @endif


        {{-- Tabla de productos --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 fw-bold">

                    <i class="bi bi-box-seam me-2"></i>

                    Productos

                </h5>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="px-3">
                                    ID
                                </th>

                                <th>
                                    Producto
                                </th>

                                <th>
                                    Precio
                                </th>

                                <th>
                                    Cantidad
                                </th>

                                <th>
                                    Categoría
                                </th>

                                <th>
                                    Proveedor
                                </th>

                                <th class="text-center">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($products as $product)
                                <tr>

                                    {{-- ID --}}
                                    <td class="px-3">
                                        {{ $product->id }}
                                    </td>


                                    {{-- Producto --}}
                                    <td>

                                        <strong>
                                            {{ $product->name }}
                                        </strong>

                                    </td>


                                    {{-- Precio --}}
                                    <td>

                                        $ {{ number_format($product->price, 0, ',', '.') }}

                                    </td>


                                    {{-- Cantidad --}}
                                    <td>

                                        <span class="badge text-bg-secondary">

                                            {{ $product->quantity }}

                                        </span>

                                    </td>


                                    {{-- Categoría --}}
                                    <td>

                                        {{ $product->category->name ?? 'Sin categoría' }}

                                    </td>


                                    {{-- Proveedor --}}
                                    <td>

                                        {{ $product->provider->name ?? 'Sin proveedor' }}

                                    </td>


                                    {{-- Acciones --}}
                                    <td class="text-center">

                                        <div class="btn-group" role="group">

                                            {{-- Ver --}}
                                            <a href="{{ route('products.show', $product) }}"
                                                class="btn btn-sm btn-outline-secondary" title="Ver">
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            {{-- Editar --}}
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="btn btn-sm btn-outline-secondary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>


                                            {{-- Eliminar --}}
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('¿Está seguro de eliminar este producto?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-dark" title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>


                                            {{-- PDF --}}
                                            <button type="button" class="btn btn-sm btn-outline-secondary" title="PDF">

                                                <i class="bi bi-file-earmark-pdf"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <i class="bi bi-box-seam fs-1 text-muted"></i>

                                        <p class="mt-3 mb-0 text-muted">

                                            No hay productos registrados.

                                        </p>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if ($products->hasPages())
                    <div class="border-top px-3 py-3">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
