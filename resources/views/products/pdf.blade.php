<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte del producto</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        body {
            background-color: #f9f9f9;
            color: #333;
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 1000px;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #2E7D32;
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        table thead tr {
            background-color: #4CAF50;
            color: white;
            text-align: left;
            font-weight: bold;
        }

        table th,
        table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tbody tr: :last-of-type {
            border-bottom: 2px solid #4CAF50;
        }

        .higlight {
            background-color: #E8F5E9 !important;
            font-weight: 500;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .info-box {
            background-color: #E3F2FD;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }

        .info-box h3 {
            margin-top: 0;
            color: #0D47A1;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
            <h1>Reporte del producto</h1>
            <p>Información del producto registrado en el inventario.</p>
        </div>

        <div class="info-box">
            <h3>Información del producto</h3>
            <p><strong>ID:</strong> {{ $product->id }}</p>
            <p><strong>Nombre:</strong> {{ $product->name }}</p>
            <p><strong>Categoría:</strong> {{ $product->category?->name ?? 'Sin categoría' }}</p>
            <p><strong>Proveedor:</strong> {{ $product->provider?->name ?? 'Sin proveedor' }}</p>
            <p><strong>Precio:</strong> ${{ number_format($product->price, 0, ',', '.') }}</p>
            <p><strong>Cantidad disponible:</strong> {{ $product->quantity }}</p>
        </div>

        @if ($product->image)
            <div class="text-center">
                <img src="{{ public_path('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    style="max-width: 300px; border-radius: 8px;">
            </div>
        @endif

        <div class="footer">
            <p>
                Generado el: {{ date('d/m/Y H:i') }}
            </p>
        </div>

    </div>
</body>

</html>
