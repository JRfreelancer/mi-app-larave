@extends('layouts.app')

@section('title', 'Proveedores | Inventrario API App')

@section('content')

<div class="container py-5">

    {{-- Encabezado --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

        <div>
            <h1 class="h2 fw-bold mb-1">
                <i class="bi bi-truck me-2"></i>
                Proveedores
            </h1>

            <p class="text-muted mb-0">
                Administra los proveedores del inventario.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <a href="{{ route('providers.create') }}" class="btn btn-gray">
                <i class="bi bi-plus-lg me-1"></i>
                Nuevo proveedor
            </a>
        </div>

    </div>


    {{-- Mensaje de éxito --}}
    @if(session('success'))

        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar">
            </button>
        </div>

    @endif


    {{-- Tabla de proveedores --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="px-4">ID</th>
                            <th>Proveedor</th>
                            <th>Contacto</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($providers as $provider)

                            <tr>

                                <td class="px-4">
                                    {{ $provider->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $provider->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $provider->contact ?? '—' }}
                                </td>

                                <td>
                                    {{ $provider->phone ?? '—' }}
                                </td>

                                <td>
                                    {{ $provider->email ?? '—' }}
                                </td>

                                <td>
                                    {{ $provider->address ?? '—' }}
                                </td>

                                <td>

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- Ver --}}
                                        <a
                                            href="{{ route('providers.show', $provider) }}"
                                            class="btn btn-sm btn-outline-dark"
                                            title="Ver proveedor">
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- Editar --}}
                                        <a
                                            href="{{ route('providers.edit', $provider) }}"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Editar proveedor">
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- Eliminar --}}
                                        <form
                                            action="{{ route('providers.destroy', $provider) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Está seguro de eliminar este proveedor?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-dark"
                                                title="Eliminar proveedor">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-5">

                                    <i class="bi bi-truck fs-1 text-muted"></i>

                                    <p class="mt-3 mb-2 fw-semibold">
                                        No hay proveedores registrados.
                                    </p>

                                    <p class="text-muted mb-3">
                                        Comienza agregando tu primer proveedor.
                                    </p>

                                    <a
                                        href="{{ route('providers.create') }}"
                                        class="btn btn-gray">
                                        <i class="bi bi-plus-lg me-1"></i>
                                        Agregar proveedor
                                    </a>

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
