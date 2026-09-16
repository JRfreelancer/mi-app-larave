<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="bi bi-box-seam me-2"></i>
            Inventrario API App
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrincipal"
            aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Mostrar navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPrincipal">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i>
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-box me-1"></i>
                        Productos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-tags me-1"></i>
                        Categorías
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('providers.index') }}">
                        <i class="bi bi-truck me-1"></i>
                        Proveedores
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>
