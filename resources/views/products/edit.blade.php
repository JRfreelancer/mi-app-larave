@extends('layouts.app')

@section('title', 'Editar producto | Inventrario API App')

@section('content')

<div class="container py-5">

    {{-- Encabezado --}}
    <div class="mb-4">

        <a href="{{ route('products.show', $product) }}"
           class="text-decoration-none text-dark">
            <i class="bi bi-arrow-left me-1"></i>
            Volver al producto
        </a>

        <h1 class="h2 fw-bold mt-3 mb-1">
            <i class="bi bi-pencil me-2"></i>
            Editar producto
        </h1>

        <p class="text-muted mb-0">
            Modifica la información del producto registrado.
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

            <form action="{{ route('products.update', $product) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Nombre --}}
                    <div class="col-12">

                        <label for="name" class="form-label fw-semibold">
                            Nombre del producto
                            <span class="text-muted">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $product->name) }}"
                            maxlength="100"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Precio --}}
                    <div class="col-md-4">

                        <label for="price" class="form-label fw-semibold">
                            Precio
                            <span class="text-muted">*</span>
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', $product->price) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Cantidad --}}
                    <div class="col-md-4">

                        <label for="quantity" class="form-label fw-semibold">
                            Cantidad
                            <span class="text-muted">*</span>
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            class="form-control @error('quantity') is-invalid @enderror"
                            value="{{ old('quantity', $product->quantity) }}"
                            min="0"
                            step="1"
                            required
                        >

                        <div class="form-text">
                            La cantidad puede ser 0, pero no puede ser negativa.
                        </div>

                        @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Categoría --}}
                    <div class="col-md-4">

                        <label for="category_id" class="form-label fw-semibold">
                            Categoría
                            <span class="text-muted">*</span>
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Selecciona una categoría
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Proveedor --}}
                    <div class="col-md-6">

                        <label for="provider_id" class="form-label fw-semibold">
                            Proveedor
                            <span class="text-muted">*</span>
                        </label>

                        <select
                            name="provider_id"
                            id="provider_id"
                            class="form-select @error('provider_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Selecciona un proveedor
                            </option>

                            @foreach($providers as $provider)

                                <option
                                    value="{{ $provider->id }}"
                                    {{ old('provider_id', $product->provider_id) == $provider->id ? 'selected' : '' }}
                                >
                                    {{ $provider->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('provider_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Información --}}
                    <div class="col-md-6">

                        <div class="bg-light border rounded p-3 h-100">

                            <div class="fw-semibold mb-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Información
                            </div>

                            <p class="small text-muted mb-0">
                                Puedes modificar todos los datos del producto.
                                La cantidad puede ser 0, pero nunca puede ser negativa.
                            </p>

                        </div>

                    </div>

                    {{-- Botones --}}
                    <div class="col-12">

                        <hr class="my-2">

                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">

                            <a
                                href="{{ route('products.show', $product) }}"
                                class="btn btn-outline-secondary"
                            >
                                <i class="bi bi-x-lg me-1"></i>
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="btn btn-gray"
                            >
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
