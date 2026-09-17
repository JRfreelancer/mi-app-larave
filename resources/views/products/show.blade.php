@extends('layouts.app')

@section('title', 'Ver producto | Inventrario API App')

@section('content')
<div class="container py-5">
    {{-- Encabezado --}}
    <div class="mb-4">
        <a href="{{ route('home') }}" class="text-decoration-none text-dark">
            <i class="bi bi-arrow-left me-1"></i> Volver al inventario
        </a>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-3">
            <div>
                <h1 class="h2 fw-bold mb-1">
                    <i class="bi bi-box-seam me-2"></i> Detalle del producto
                </h1>
                <p class="text-muted mb-0"> Información del producto registrado en el inventario. </p>
            </div>
            <div>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-gray">
                    <i class="bi bi-pencil me-1"></i> Editar producto
                </a>
            </div>
        </div>
    </div>

    {{-- Información principal --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-info-circle me-2"></i> Información del producto
            </h5>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                {{-- Imagen --}}
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100 shadow-sm">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 350px;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Detalles principales --}}
                <div class="col-md-6">
                    <div class="row g-3">
                        {{-- ID --}}
                        <div class="col-md-12">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted mb-1"> ID </div>
                                <div class="fw-semibold"> {{ $product->id }} </div>
                            </div>
                        </div>
                        {{-- Nombre --}}
                        <div class="col-md-12">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted mb-1"> Producto </div>
                                <div class="fw-semibold"> {{ $product->name }} </div>
                            </div>
                        </div>
                        {{-- Precio --}}
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted mb-1"> Precio </div>
                                <div class="fw-semibold"> $ {{ number_format($product->price, 0, ',', '.') }} </div>
                            </div>
                        </div>
                        {{-- Cantidad --}}
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted mb-1"> Cantidad disponible </div>
                                <div>
                                    <span class="badge text-bg-secondary fs-6"> {{ $product->quantity }} </span>
                                </div>
                            </div>
                        </div>
                        {{-- Categoría --}}
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="small text-muted mb-1"> Categoría </div>
                                <div class="fw-semibold"> {{ $product->category->name ?? 'Sin categoría' }} </div>
                            </div>
                        </div>
                        {{-- Proveedor --}}
                        <div class="col-12">
                            <div class="border rounded p-3">
                                <div class="small text-muted mb-1"> Proveedor </div>
                                <div class="fw-semibold"> {{ $product->provider->name ?? 'Sin proveedor' }} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Acciones --}}
        <div class="card-footer bg-white p-3">
            <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-gray">
                    <i class="bi bi-pencil me-1"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
