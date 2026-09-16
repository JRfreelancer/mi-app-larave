<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Inventrario API App')
    </title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --gray-dark: #212529;
            --gray-medium: #495057;
            --gray: #6c757d;
            --gray-light: #adb5bd;
            --gray-soft: #e9ecef;
            --gray-background: #f8f9fa;
        }

        body {
            background-color: var(--gray-background);
            color: var(--gray-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .btn-gray {
            background-color: var(--gray-dark);
            border-color: var(--gray-dark);
            color: #fff;
        }

        .btn-gray:hover {
            background-color: #000;
            border-color: #000;
            color: #fff;
        }

        .table thead {
            background-color: var(--gray-dark);
            color: #fff;
        }

        .navbar-dark {
            background-color: var(--gray-dark) !important;
        }

        .footer {
            background-color: var(--gray-dark);
            color: #fff;
        }
    </style>

    @stack('styles')
</head>

<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    @stack('scripts')

</body>
</html>
