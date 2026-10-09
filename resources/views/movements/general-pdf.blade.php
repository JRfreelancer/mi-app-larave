<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <style>

        @page {
            margin: 30px 30px 40px 30px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 8.5pt;
            color: #222;
        }

        /* ENCABEZADO */

        .header {
            width: 100%;
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .title {
            font-size: 17pt;
            font-weight: bold;
        }

        .subtitle {
            margin-top: 4px;
            font-size: 8.5pt;
            color: #666;
        }

        .date {
            text-align: right;
            font-size: 8pt;
            color: #555;
        }

        /* PERIODO */

        .period {
            margin-bottom: 15px;
            padding: 8px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }

        /* RESUMEN */

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .summary td {
            width: 25%;
            border: 1px solid #ddd;
            padding: 9px;
            text-align: center;
        }

        .summary-label {
            display: block;
            font-size: 7.5pt;
            color: #666;
            margin-bottom: 4px;
        }

        .summary-value {
            display: block;
            font-size: 15pt;
            font-weight: bold;
        }

        /* TABLA */

        .section-title {
            background-color: #222;
            color: white;
            padding: 7px;
            font-size: 9pt;
            font-weight: bold;
            margin-bottom: 0;
        }

        .movements {
            width: 100%;
            border-collapse: collapse;
        }

        .movements th {
            background-color: #eeeeee;
            border: 1px solid #d0d0d0;
            padding: 6px 5px;
            font-size: 7.5pt;
            text-align: left;
        }

        .movements td {
            border: 1px solid #ddd;
            padding: 6px 5px;
            vertical-align: top;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .entrada {
            color: #198754;
            font-weight: bold;
        }

        .salida {
            color: #dc3545;
            font-weight: bold;
        }

        .product {
            font-weight: bold;
        }

        /* TOTALES */

        .totals {
            margin-top: 15px;
            width: 100%;
            border-collapse: collapse;
        }

        .totals td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .total-label {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .total-value {
            text-align: right;
            font-weight: bold;
        }

        /* PIE */

        .footer {
            margin-top: 25px;
            padding-top: 7px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 7pt;
            color: #777;
        }

    </style>

</head>

<body>

    {{-- ENCABEZADO --}}

    <div class="header">

        <table class="header-table">

            <tr>

                <td>

                    <div class="title">
                        REPORTE GENERAL DE MOVIMIENTOS
                    </div>

                    <div class="subtitle">
                        Sistema de Inventario
                    </div>

                </td>

                <td class="date">

                    Generado el<br>

                    {{ now()->format('d/m/Y H:i:s') }}

                </td>

            </tr>

        </table>

    </div>


    {{-- PERIODO --}}

    <div class="period">

        <strong>Período del reporte:</strong>

        @if ($fechaDesde && $fechaHasta)

            {{ $fechaDesde->format('d/m/Y') }}
            -
            {{ $fechaHasta->format('d/m/Y') }}

        @else

            Sin movimientos registrados.

        @endif

    </div>


    {{-- RESUMEN --}}

    <table class="summary">

        <tr>

            <td>

                <span class="summary-label">
                    TOTAL MOVIMIENTOS
                </span>

                <span class="summary-value">
                    {{ $totalMovements }}
                </span>

            </td>

            <td>

                <span class="summary-label">
                    ENTRADAS
                </span>

                <span class="summary-value">
                    {{ $cantidadEntradas }}
                </span>

            </td>

            <td>

                <span class="summary-label">
                    UNIDADES INGRESADAS
                </span>

                <span class="summary-value">
                    {{ $totalEntradas }}
                </span>

            </td>

            <td>

                <span class="summary-label">
                    UNIDADES SALIDAS
                </span>

                <span class="summary-value">
                    {{ $totalSalidas }}
                </span>

            </td>

        </tr>

    </table>


    {{-- DETALLE --}}

    <div class="section-title">
        DETALLE DE MOVIMIENTOS
    </div>

    <table class="movements">

        <thead>

            <tr>

                <th class="center" width="5%">
                    #
                </th>

                <th width="13%">
                    Fecha
                </th>

                <th width="22%">
                    Producto
                </th>

                <th class="center" width="10%">
                    Tipo
                </th>

                <th class="right" width="9%">
                    Cant.
                </th>

                <th width="16%">
                    Motivo
                </th>

                <th width="25%">
                    Observación
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse ($movements as $movement)

                <tr>

                    <td class="center">
                        {{ $movement->id }}
                    </td>

                    <td>
                        {{ $movement->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td class="product">
                        {{ $movement->product->name }}
                    </td>

                    <td class="center">

                        @if ($movement->type === 'entrada')

                            <span class="entrada">
                                ENTRADA
                            </span>

                        @else

                            <span class="salida">
                                SALIDA
                            </span>

                        @endif

                    </td>

                    <td class="right">
                        {{ $movement->quantity }}
                    </td>

                    <td>
                        {{ $movement->reason ?: '—' }}
                    </td>

                    <td>
                        {{ $movement->observation ?: '—' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="center">
                        No existen movimientos registrados.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- TOTALES --}}

    <table class="totals">

        <tr>

            <td class="total-label">
                Total unidades ingresadas
            </td>

            <td class="total-value">
                {{ $totalEntradas }} unidad(es)
            </td>

        </tr>

        <tr>

            <td class="total-label">
                Total unidades retiradas
            </td>

            <td class="total-value">
                {{ $totalSalidas }} unidad(es)
            </td>

        </tr>

    </table>


    {{-- PIE --}}

    <div class="footer">

        Documento generado automáticamente por el Sistema de Inventario

        · Total de movimientos: {{ $totalMovements }}

    </div>

</body>

</html>
