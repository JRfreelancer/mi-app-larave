@extends('layouts.app')

@section('title', 'Editar proveedor | Inventrario API App')

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

        <h1 class="h2 fw-bold mt-3 mb-1">
            <i class="bi bi-pencil me-2"></i>
            Editar proveedor
        </h1>

        <p class="text-muted mb-0">
            Modifica la información de {{ $provider->name }}.
        </p>

    </div>


    {{-- Errores de validación --}}
    @if($errors->any())

        <div class="alert alert-secondary">

            <strong>
                <i class="bi bi-exclamation-circle me-2"></i>
                Revisa los siguientes datos:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Formulario --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-md-5">

            <form
                action="{{ route('providers.update', $provider) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Nombre --}}
                    <div class="col-12">

                        <label for="name" class="form-label fw-semibold">
                            Nombre del proveedor
                            <span class="text-muted">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $provider->name) }}"
                            maxlength="100"
                            required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Contacto --}}
                    <div class="col-md-6">

                        <label for="contact" class="form-label fw-semibold">
                            Persona de contacto
                        </label>

                        <input
                            type="text"
                            name="contact"
                            id="contact"
                            class="form-control @error('contact') is-invalid @enderror"
                            value="{{ old('contact', $provider->contact) }}"
                            maxlength="100">

                        @error('contact')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Teléfono --}}
                    <div class="col-md-6">

                        <label for="phone" class="form-label fw-semibold">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $provider->phone) }}"
                            maxlength="30">

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="col-md-6">

                        <label for="email" class="form-label fw-semibold">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $provider->email) }}"
                            maxlength="150">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Dirección --}}
                    <div class="col-md-6">

                        <label for="address" class="form-label fw-semibold">
                            Dirección
                        </label>

                        <input
                            type="text"
                            name="address"
                            id="address"
                            class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address', $provider->address) }}"
                            maxlength="200">

                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Botones --}}
                    <div class="col-12">

                        <hr class="my-2">

                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">

                            <a
                                href="{{ route('providers.show', $provider) }}"
                                class="btn btn-outline-secondary">
                                <i class="bi bi-x-lg me-1"></i>
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="btn btn-gray">
                                <i class="bi bi-check-lg me-1"></i>
                                Guardar cambios
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
