@extends('layouts.app')

@section('title', 'Movimientos de Inventario')

@section('content')

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">
                    <i class="bi bi-arrow-left-right me-2"></i>
                    Movimientos de Inventario
                </h1>
                @if ($lowStockProducts->isNotEmpty())
                    <div class="alert alert-warning border-0 shadow-sm mt-4" role="alert">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                            <div>
                                <h5 class="alert-heading mb-1">
                                    Alerta de stock bajo
                                </h5>

                                <p class="mb-2">
                                    Hay
                                    <strong>{{ $lowStockProducts->count() }}</strong>
                                    producto(s) con menos de 5 unidades disponibles.
                                </p>

                                <div class="small">
                                    <strong>Productos afectados:</strong>

                                    <ul class="mb-0 mt-2">
                                        @foreach ($lowStockProducts as $product)
                                            <li>
                                                {{ $product->name }}
                                                —
                                                <strong>{{ $product->quantity }}</strong>
                                                unidad(es)
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div>
                <button type="button" class="btn btn-gray me-2" data-bs-toggle="modal" data-bs-target="#modalEntrada">
                    <i class="bi bi-box-arrow-in-down me-1"></i>
                    Entrada
                </button>

                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalSalida">
                    <i class="bi bi-box-arrow-up me-1"></i>
                    Salida
                </button>

            </div>
        </div>

    </div>

    <!-- Historial de movimientos -->
    <div class="container pb-5">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2"></i>
                    Historial de movimientos
                </h5>
            </div>

            <div class="card-body p-0">

                @if ($movements->isEmpty())

                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <p class="mb-0">
                            No hay movimientos registrados.
                        </p>
                    </div>
                @else
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Tipo</th>
                                    <th>Cantidad</th>
                                    <th>Existencia</th>
                                    <th>Estado</th>
                                    <th>Motivo</th>
                                    <th>Observación</th>
                                    <th>Fecha</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($movements as $movement)
                                    <tr>

                                        <td class="ps-4 fw-semibold">
                                            {{ $movement->product->name }}
                                        </td>

                                        <td>
                                            @if ($movement->type === 'entrada')
                                                <span class="badge text-bg-dark">
                                                    <i class="bi bi-box-arrow-in-down me-1"></i>
                                                    Entrada
                                                </span>
                                            @else
                                                <span class="badge text-bg-secondary">
                                                    <i class="bi bi-box-arrow-up me-1"></i>
                                                    Salida
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($movement->product->quantity == 0)
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-x-circle-fill me-1"></i>
                                                    Agotado
                                                </span>
                                            @elseif ($movement->product->quantity < 10)
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                                    Stock bajo
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                    Stock alto
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <strong>
                                                {{ $movement->product->quantity }}
                                            </strong>
                                            unidad(es)
                                        </td>

                                        <td>
                                            {{ $movement->reason ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $movement->observation ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $movement->created_at->format('d/m/Y H:i') }}
                                        </td>

                                        <td class="text-center">

                                            <a href="{{ route('movements.pdf', $movement->id) }}" target="_blank"
                                                class="btn btn-sm btn-outline-dark" title="Generar PDF">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>

        </div>

    </div>

    <!-- Modal Entrada -->
    <div class="modal fade" id="modalEntrada" tabindex="-1" aria-labelledby="modalEntradaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalEntradaLabel">
                        <i class="bi bi-box-arrow-in-down me-2"></i>
                        Registrar entrada
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="entradaProducto" class="form-label">
                            Producto
                        </label>

                        <select id="entradaProducto" name="product_id" class="form-select" required>
                            <option value="" selected disabled>
                                Seleccione un producto
                            </option>

                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-stock="{{ $product->quantity }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="entradaCantidad" class="form-label">
                            Cantidad
                        </label>

                        <input type="number" id="entradaCantidad" name="quantity" class="form-control" min="1"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="entradaMotivo" class="form-label">
                            Motivo
                        </label>

                        <input type="text" id="entradaMotivo" name="reason" class="form-control"
                            placeholder="Ej. Compra">
                    </div>

                    <div class="mb-3">
                        <label for="entradaObservacion" class="form-label">
                            Observación
                        </label>

                        <textarea id="entradaObservacion" name="observation" class="form-control" rows="3"
                            placeholder="Observaciones del movimiento"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="button" class="btn btn-gray" id="btnRegistrarEntrada">
                        <i class="bi bi-check-lg me-1"></i>
                        Registrar entrada
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Salida -->
    <div class="modal fade" id="modalSalida" tabindex="-1" aria-labelledby="modalSalidaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalSalidaLabel">
                        <i class="bi bi-box-arrow-up me-2"></i>
                        Registrar salida
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="salidaProducto" class="form-label">
                            Producto
                        </label>

                        <select id="salidaProducto" name="product_id" class="form-select" required>
                            <option value="" selected disabled>
                                Seleccione un producto
                            </option>

                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-stock="{{ $product->quantity }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>

                        <div id="stockDisponible" class="form-text mt-2">
                            Seleccione un producto para consultar el stock disponible.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="salidaCantidad" class="form-label">
                            Cantidad
                        </label>

                        <input type="number" id="salidaCantidad" name="quantity" class="form-control" min="1"
                            required>

                        <div id="mensajeStock" class="invalid-feedback">
                            La cantidad supera el stock disponible.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="salidaMotivo" class="form-label">
                            Motivo
                        </label>

                        <input type="text" id="salidaMotivo" name="reason" class="form-control"
                            placeholder="Ej. Venta">
                    </div>

                    <div class="mb-3">
                        <label for="salidaObservacion" class="form-label">
                            Observación
                        </label>

                        <textarea id="salidaObservacion" name="observation" class="form-control" rows="3"
                            placeholder="Observaciones del movimiento"></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="button" class="btn btn-gray" id="btnRegistrarSalida">
                        <i class="bi bi-check-lg me-1"></i>
                        Registrar salida
                    </button>

                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const salidaProducto = document.getElementById('salidaProducto');
                const salidaCantidad = document.getElementById('salidaCantidad');
                const stockDisponible = document.getElementById('stockDisponible');
                const mensajeStock = document.getElementById('mensajeStock');
                const btnRegistrarSalida = document.getElementById('btnRegistrarSalida');

                /*
                |--------------------------------------------------------------------------
                | Actualizar stock al seleccionar producto
                |--------------------------------------------------------------------------
                */

                salidaProducto.addEventListener('change', function() {

                    const option = this.options[this.selectedIndex];
                    const stock = parseInt(option.dataset.stock || 0);

                    salidaCantidad.max = stock;

                    stockDisponible.innerHTML =
                        `<strong>Stock disponible:</strong> ${stock} unidad(es).`;

                    validarCantidadSalida();
                });


                /*
                |--------------------------------------------------------------------------
                | Validar cantidad
                |--------------------------------------------------------------------------
                */

                function validarCantidadSalida() {

                    const option = salidaProducto.options[salidaProducto.selectedIndex];

                    if (!option || !option.dataset.stock) {
                        return false;
                    }

                    const stock = parseInt(option.dataset.stock);
                    const cantidad = parseInt(salidaCantidad.value || 0);

                    if (cantidad > stock) {

                        salidaCantidad.classList.add('is-invalid');

                        mensajeStock.textContent =
                            `No puedes retirar ${cantidad} unidad(es). Solo hay ${stock} disponible(s).`;

                        btnRegistrarSalida.disabled = true;

                        return false;
                    }

                    if (cantidad < 1) {
                        btnRegistrarSalida.disabled = true;
                        return false;
                    }

                    salidaCantidad.classList.remove('is-invalid');
                    btnRegistrarSalida.disabled = false;

                    return true;
                }


                salidaCantidad.addEventListener('input', validarCantidadSalida);


                /*
                |--------------------------------------------------------------------------
                | Registrar salida
                |--------------------------------------------------------------------------
                */

                btnRegistrarSalida.addEventListener('click', async function() {

                    if (!salidaProducto.value) {
                        alert('Debe seleccionar un producto.');
                        return;
                    }

                    if (!validarCantidadSalida()) {
                        return;
                    }

                    const data = {
                        product_id: parseInt(salidaProducto.value),
                        type: 'salida',
                        quantity: parseInt(salidaCantidad.value),
                        reason: document.getElementById('salidaMotivo').value,
                        observation: document.getElementById('salidaObservacion').value
                    };

                    try {

                        btnRegistrarSalida.disabled = true;

                        const response = await fetch('/api/movements', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(data)
                        });

                        const result = await response.json();

                        if (!response.ok) {

                            if (result.errors) {

                                const mensajes = Object.values(result.errors)
                                    .flat()
                                    .join('\n');

                                throw new Error(mensajes);
                            }

                            throw new Error(
                                result.message || 'No se pudo registrar la salida.'
                            );
                        }

                        /*
                         * Cerramos el modal
                         */
                        const modalElement = document.getElementById('modalSalida');
                        const modal = bootstrap.Modal.getInstance(modalElement);

                        if (modal) {
                            modal.hide();
                        }

                        /*
                         * Recargamos la página para actualizar:
                         * - stock
                         * - alerta
                         * - historial
                         */
                        window.location.reload();

                    } catch (error) {

                        alert(error.message);

                        btnRegistrarSalida.disabled = false;
                    }
                });


                /*
                |--------------------------------------------------------------------------
                | Limpiar modal al cerrarlo
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById('modalSalida')
                    .addEventListener('hidden.bs.modal', function() {

                        salidaProducto.value = '';
                        salidaCantidad.value = '';
                        salidaCantidad.removeAttribute('max');

                        document.getElementById('salidaMotivo').value = '';
                        document.getElementById('salidaObservacion').value = '';

                        stockDisponible.innerHTML =
                            'Seleccione un producto para consultar el stock disponible.';

                        salidaCantidad.classList.remove('is-invalid');

                        btnRegistrarSalida.disabled = false;
                    });

            });
        </script>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const btnRegistrarEntrada = document.getElementById('btnRegistrarEntrada');

                btnRegistrarEntrada.addEventListener('click', async function() {

                    const productId = document.getElementById('entradaProducto').value;
                    const quantity = document.getElementById('entradaCantidad').value;
                    const reason = document.getElementById('entradaMotivo').value;
                    const observation = document.getElementById('entradaObservacion').value;

                    if (!productId) {
                        alert('Seleccione un producto.');
                        return;
                    }

                    if (!quantity || quantity < 1) {
                        alert('Ingrese una cantidad válida.');
                        return;
                    }

                    try {

                        const response = await fetch('/api/movements', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                type: 'entrada',
                                quantity: quantity,
                                reason: reason,
                                observation: observation
                            })
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(
                                data.message || 'No se pudo registrar la entrada.'
                            );
                        }

                        alert('Entrada registrada correctamente.');

                        window.location.reload();

                    } catch (error) {

                        console.error(error);

                        alert(error.message);
                    }
                });

            });
        </script>
    @endpush

@endsection
