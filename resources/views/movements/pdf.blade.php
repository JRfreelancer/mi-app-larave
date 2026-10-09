<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 35px 40px 45px 40px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            color: #222222;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #222222;
            padding-bottom: 12px;
            margin-bottom: 22px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-left {
            width: 70%;
        }

        .header-right {
            width: 30%;
            text-align: right;
            vertical-align: top;
        }

        .title {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
        }

        .subtitle {
            font-size: 9pt;
            color: #666666;
            margin-top: 5px;
        }

        .movement-number {
            font-size: 10pt;
            font-weight: bold;
        }

        .movement-date {
            font-size: 8.5pt;
            color: #666666;
            margin-top: 4px;
        }

        .section {
            margin-bottom: 18px;
        }

        .section-title {
            background-color: #222222;
            color: #ffffff;
            font-size: 9pt;
            font-weight: bold;
            padding: 7px 9px;
            text-transform: uppercase;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data td {
            border: 1px solid #d9d9d9;
            padding: 8px 9px;
            vertical-align: middle;
        }

        .label {
            width: 30%;
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .value {
            width: 70%;
        }

        .entrada {
            color: #198754;
            font-weight: bold;
        }

        .salida {
            color: #dc3545;
            font-weight: bold;
        }

        .quantity-box {
            text-align: center;
            padding: 12px;
            border: 1px solid #d9d9d9;
            background-color: #f7f7f7;
        }

        .quantity-number {
            font-size: 20pt;
            font-weight: bold;
        }

        .quantity-label {
            font-size: 8pt;
            color: #666666;
        }

        .observation {
            min-height: 55px;
            vertical-align: top !important;
        }

        .signatures {
            width: 100%;
            margin-top: 55px;
            border-collapse: collapse;
        }

        .signatures td {
            width: 50%;
            text-align: center;
            padding: 0 25px;
        }

        .signature-line {
            border-top: 1px solid #333333;
            margin-bottom: 6px;
        }

        .signature-label {
            font-size: 8.5pt;
        }

        .footer {
            margin-top: 35px;
            padding-top: 8px;
            border-top: 1px solid #dddddd;
            text-align: center;
            font-size: 7.5pt;
            color: #777777;
        }
    </style>
</head>

<body>

    {{-- ENCABEZADO --}}
    <div class="header">

        <table class="header-table">
            <tr>

                <td class="header-left">

                    <div class="title">
                        REPORTE DE MOVIMIENTO
                    </div>

                    <div class="subtitle">
                        Sistema de Inventario
                    </div>

                </td>

                <td class="header-right">

                    <div class="movement-number">
                        Movimiento #{{ $movement->id }}
                    </div>

                    <div class="movement-date">
                        {{ $movement->created_at->format('d/m/Y H:i:s') }}
                    </div>

                </td>

            </tr>
        </table>

    </div>


    {{-- INFORMACIÓN DEL MOVIMIENTO --}}
    <div class="section">

        <div class="section-title">
            Información del movimiento
        </div>

        <table class="data">

            <tr>

                <td class="label">
                    Tipo de movimiento
                </td>

                <td class="value">

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

            </tr>

            <tr>

                <td class="label">
                    Fecha y hora
                </td>

                <td class="value">
                    {{ $movement->created_at->format('d/m/Y H:i:s') }}
                </td>

            </tr>

            <tr>

                <td class="label">
                    Motivo
                </td>

                <td class="value">
                    {{ $movement->reason ?: 'No especificado' }}
                </td>

            </tr>

        </table>

    </div>


    {{-- INFORMACIÓN DEL PRODUCTO --}}
    <div class="section">

        <div class="section-title">
            Información del producto
        </div>

        <table class="data">

            <tr>

                <td class="label">
                    Producto
                </td>

                <td class="value">
                    <strong>
                        {{ $movement->product->name }}
                    </strong>
                </td>

            </tr>

            <tr>

                <td class="label">
                    Cantidad del movimiento
                </td>

                <td class="value">

                    <strong style="font-size: 14pt;">
                        {{ $movement->quantity }}
                    </strong>

                    unidad(es)

                </td>

            </tr>

            <tr>

                <td class="label">
                    Existencia actual
                </td>

                <td class="value">

                    <strong>
                        {{ $movement->product->quantity }}
                    </strong>

                    unidad(es)

                </td>

            </tr>

        </table>

    </div>


    {{-- OBSERVACIONES --}}
    <div class="section">

        <div class="section-title">
            Observaciones
        </div>

        <table class="data">

            <tr>

                <td class="observation">

                    @if ($movement->observation)

                        {{ $movement->observation }}

                    @else

                        Sin observaciones.

                    @endif

                </td>

            </tr>

        </table>

    </div>


    {{-- FIRMAS --}}
    <table class="signatures">

        <tr>

            <td>

                <div class="signature-line"></div>

                <div class="signature-label">
                    Responsable
                </div>

            </td>

            <td>

                <div class="signature-line"></div>

                <div class="signature-label">
                    Sistema de Inventario
                </div>

            </td>

        </tr>

    </table>


    {{-- PIE --}}
    <div class="footer">

        Documento generado automáticamente por el Sistema de Inventario
        · Movimiento #{{ $movement->id }}

    </div>

</body>

</html>
