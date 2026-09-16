@extends('layouts.app')

@section('title', 'Proveedor | Inventrario API App')

@section('content')

<div class="container py-5">

    {{-- Encabezado --}}
    <div class="mb-4">

        <a
            href="{{ route('providers.index') }}"
            class="text-decoration-none text-dark">
            <i class="bi bi-arrow-left me-1"></i>
            Volver a proveedores
        </a>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-3">

            <div>
                <h1 class="h2 fw-bold mb-1">
                    <i class="bi bi-truck me-2"></i>
                    {{ $provider->name }}
                </h1>

                <p class="text-muted mb-0">
                    Información del proveedor.
                </p>
            </div>

            <div class="mt-3 mt-md-0">

                <a
                    href="{{ route('providers.edit', $provider) }}"
                    class="btn btn-gray">
                    <i class="bi bi-pencil me-1"></i>
                    Editar proveedor
                </a>

            </div>

        </div>

    </div>


    {{-- Información del proveedor --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-dark text-white">
            <i class="bi bi-info-circle me-2"></i>
            Información del proveedor
        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">

                    <div class="text-muted small">
                        Nombre
                    </div>

                    <div class="fw-semibold">
                        {{ $provider->name }}
                    </div>

                </div>


                <div class="col-md-6">

                    <div class="text-muted small">
                        Persona de contacto
                    </div>

                    <div class="fw-semibold">
                        {{ $provider->contact ?? 'No registrado' }}
                    </div>

                </div>


                <div class="col-md-6">

                    <div class="text-muted small">
                        Teléfono
                    </div>

                    <div class="fw-semibold">
                        {{ $provider->phone ?? 'No registrado' }}
                    </div>

                </div>


                <div class="col-md-6">

                    <div class="text-muted small">
                        Correo electrónico
                    </div>

                    <div class="fw-semibold">
                        {{ $provider->email ?? 'No registrado' }}
                    </div>

                </div>


                <div class="col-12">

                    <div class="text-muted small">
                        Dirección
                    </div>

                    <div class="fw-semibold">
                        {{ $provider->address ?? 'No registrada' }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Productos asociados --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-dark text-white">
            <i class="bi bi-box-seam me-2"></i>
            Productos asociados
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="px-4">ID</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($provider->products as $product)

                            <tr>

                                <td class="px-4">
                                    {{ $product->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $product->name }}
                                    </strong>
                                </td>

                                <td>
                                    ${{ number_format($product->price, 2, ',', '.') }}
                                </td>

                                <td>
                                    {{ $product->quantity }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-5">

                                    <i class="bi bi-box-seam fs-1 text-muted"></i>

                                    <p class="mt-3 mb-0 text-muted">
                                        Este proveedor todavía no tiene productos asociados.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
