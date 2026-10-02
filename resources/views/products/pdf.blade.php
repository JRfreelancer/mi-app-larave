<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>Reporte del producto</title>

    <style>
        body {
            background-color: #f9f9f9;
            color: #333;
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.5;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            margin: 0 auto;
            max-width: 1000px;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #555;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #333;
            font-size: 26px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .header p {
            color: #666;
            font-size: 13px;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .info-box {
            background-color: #f1f1f1;
            border-left: 4px solid #555;
            padding: 15px;
            margin: 20px 0;
        }

        .info-box h3 {
            margin-top: 0;
            color: #333;
            font-size: 17px;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 11px;
        }

        table thead tr {
            background-color: #555;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        table th,
        table td {
            padding: 9px 7px;
            border: 1px solid #ccc;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f5f5f5;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #555;
        }

        .highlight {
            background-color: #eeeeee;
            font-weight: 500;
        }

        .product-image {
            text-align: center;
            margin: 25px 0;
        }

        .product-image img {
            max-width: 300px;
            max-height: 250px;
            border-radius: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- ENCABEZADO --}}
        <div class="header">

            <img src="{{ public_path('images/logo.png') }}"
                 alt="Logo"
                 class="logo">

            <h1>Reporte del producto</h1>

            <p>
                Información del producto registrado en el inventario.
            </p>

        </div>


        {{-- INFORMACIÓN GENERAL --}}
        <div class="info-box">

            <h3>Información del producto</h3>

            <p>
                <strong>ID:</strong>
                {{ $product->id }}
            </p>

            <p>
                <strong>Nombre:</strong>
                {{ $product->name }}
            </p>

            <p>
                <strong>Categoría:</strong>
                {{ $product->category?->name ?? 'Sin categoría' }}
            </p>

            <p>
                <strong>Proveedor:</strong>
                {{ $product->provider?->name ?? 'Sin proveedor' }}
            </p>

            <p>
                <strong>Precio unitario:</strong>
                ${{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p>
                <strong>Cantidad disponible:</strong>
                {{ $product->quantity }}
            </p>

        </div>


        {{-- TABLA DE DETALLE --}}
        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Valor inventario</th>
                </tr>

            </thead>

            <tbody>

                <tr class="highlight">

                    <td>
                        {{ $product->id }}
                    </td>

                    <td>
                        {{ $product->name }}
                    </td>

                    <td>
                        {{ $product->category?->name ?? 'Sin categoría' }}
                    </td>

                    <td>
                        {{ $product->provider?->name ?? 'Sin proveedor' }}
                    </td>

                    <td>
                        ${{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ $product->quantity }}
                    </td>

                    <td>
                        ${{ number_format($product->price * $product->quantity, 0, ',', '.') }}
                    </td>

                </tr>

            </tbody>

        </table>


        {{-- IMAGEN DEL PRODUCTO --}}
        @if ($product->image)

            <div class="product-image">

                <img
                    src="{{ public_path('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                >

            </div>

        @endif


        {{-- PIE DEL DOCUMENTO --}}
        <div class="footer">

            <p>
                &copy; {{ date('Y') }}
                Sistema de Inventario.
                Todos los derechos reservados.
            </p>

            <p>
                Documento generado automáticamente el:
            </p>

            <p>
                {{ date('d/m/Y H:i') }}
            </p>

        </div>

    </div>

</body>

</html>
