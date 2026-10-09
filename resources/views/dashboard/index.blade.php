@extends('layouts.app')

@section('title', 'Dashboard | Inventario API App')

@push('styles')
    <style>
        .dashboard-header {
            margin-bottom: 2rem;
        }

        .stock-card {
            position: relative;
            overflow: hidden;
            border: 0;
            border-radius: 16px;
            min-height: 170px;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stock-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, .10);
        }

        .stock-card .card-body {
            padding: 1.5rem;
        }

        .stock-card .stock-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stock-card .stock-label {
            font-size: .9rem;
            font-weight: 600;
            margin-bottom: .5rem;
        }

        .stock-card .stock-number {
            font-size: 2.4rem;
            line-height: 1.1;
            font-weight: 750;
            margin-bottom: .5rem;
        }

        .stock-card .stock-description {
            font-size: .82rem;
            margin-bottom: 0;
        }

        .stock-card-total {
            background: #edf2ff;
            color: #2347a5;
        }

        .stock-card-total .stock-icon {
            background: #d6e2ff;
        }

        .stock-card-low {
            background: #fff1f0;
            color: #b42318;
        }

        .stock-card-low .stock-icon {
            background: #ffd9d6;
        }

        .stock-card-medium {
            background: #fff5e6;
            color: #a65b00;
        }

        .stock-card-medium .stock-icon {
            background: #ffe4b8;
        }

        .stock-card-normal {
            background: #eaf8ef;
            color: #187443;
        }

        .stock-card-normal .stock-icon {
            background: #c9efd6;
        }

        @media (max-width: 576px) {
            .stock-card .card-body {
                padding: 1.25rem;
            }

            .stock-card .stock-number {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">

        <div class="dashboard-header">
            <h1 class="fw-bold mb-2">Dashboard</h1>

            <p class="text-secondary mb-0">
                Resumen del estado de las existencias de tu inventario.
            </p>
        </div>

        <div class="row g-4">

            {{-- Stock total --}}
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card stock-card stock-card-total h-100">
                    <div class="card-body">
                        <div class="stock-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <p class="stock-label">Stock total</p>

                        <div class="stock-number">
                            {{ number_format($stockTotal, 0, ',', '.') }}
                        </div>

                        <p class="stock-description">
                            Unidades registradas en el inventario.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Stock bajo --}}
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card stock-card stock-card-low h-100">
                    <div class="card-body">
                        <div class="stock-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>

                        <p class="stock-label">Stock bajo</p>

                        <div class="stock-number">
                            {{ number_format($stockBajo, 0, ',', '.') }}
                        </div>

                        <p class="stock-description">
                            Productos con entre 0 y 9 unidades.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Stock medio --}}
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card stock-card stock-card-medium h-100">
                    <div class="card-body">
                        <div class="stock-icon">
                            <i class="bi bi-activity"></i>
                        </div>

                        <p class="stock-label">Stock medio</p>

                        <div class="stock-number">
                            {{ number_format($stockMedio, 0, ',', '.') }}
                        </div>

                        <p class="stock-description">
                            Productos con entre 10 y 20 unidades.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Stock normal --}}
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card stock-card stock-card-normal h-100">
                    <div class="card-body">
                        <div class="stock-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <p class="stock-label">Stock normal</p>

                        <div class="stock-number">
                            {{ number_format($stockNormal, 0, ',', '.') }}
                        </div>

                        <p class="stock-description">
                            Productos con más de 20 unidades.
                        </p>
                    </div>
                </div>
            </div>

        </div>


    {{-- Tabla de productos críticos --}}
    <div class="card border-0 shadow-sm mt-5 w-100">

        <div class="card-header bg-white py-3">
            <h5 class="mb-1 fw-bold">
                <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                Productos críticos
            </h5>

            <p class="text-secondary small mb-0">
                Productos con menos de 10 unidades disponibles.
            </p>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($productosCriticos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>

                                <td class="fw-semibold">
                                    {{ $producto->name }}
                                </td>

                                <td>
                                    <span class="fw-bold">
                                        {{ number_format($producto->quantity, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td>
                                    @if ($producto->quantity == 0)
                                        <span class="badge text-bg-danger">
                                            Agotado
                                        </span>
                                    @elseif ($producto->quantity <= 4)
                                        <span class="badge text-bg-danger">
                                            Crítico
                                        </span>
                                    @else
                                        <span class="badge text-bg-warning">
                                            Stock bajo
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    No hay productos críticos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

        <div class="card-footer bg-white text-secondary small">
            Productos que requieren atención:
            <strong>{{ $productosCriticos->count() }}</strong>
        </div>

    </div>
</div>
@endsection
