<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">

    <div class="container">

        {{-- Marca del sistema --}}
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <i class="bi bi-box-seam me-2"></i>
            Inventario API App
        </a>

        {{-- Botón para dispositivos móviles --}}
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarPrincipal"
                aria-controls="navbarPrincipal"
                aria-expanded="false"
                aria-label="Mostrar navegación">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPrincipal">

            <ul class="navbar-nav ms-auto">

                {{-- Inicio --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door me-1"></i>
                        Inicio
                    </a>
                </li>

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i>
                        Dashboard
                    </a>
                </li>

                {{-- Productos --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-box me-1"></i>
                        Productos
                    </a>
                </li>

                {{-- Categorías --}}
                <li class="nav-item">
                    <a class="nav-link" href="/api/categories">
                        <i class="bi bi-tags me-1"></i>
                        Categorías
                    </a>
                </li>

                {{-- Proveedores --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('providers.index') }}">
                        <i class="bi bi-truck me-1"></i>
                        Proveedores
                    </a>
                </li>

                {{-- Movimientos --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movements.index') }}">
                        <i class="bi bi-arrow-left-right me-1"></i>
                        Movimientos
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>
