<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Remisión</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 10px;
        }

        .logo {
            width: 100px;
        }

        .header-table,
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
            font-weight: bold;
        }

        .info-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: middle;
        }

        .green-bg {
            background-color: #75c5bd;
        }

        .center {
            text-align: center;
        }

        .signature-space {
            height: 40px;
        }

        .small {
            font-size: 9px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <table class="header-table">
        <tr>
            <td rowspan="3" style="width: 25%;">
                <img src="{{ $imagen }}" alt="Logo" style="max-width: 100px;">
            </td>
            <td rowspan="3" class="green-bg">
                <h1>ASOCIACION DE RECICLADORES RECYPLUS</h1>

                <h2>NIT: 901.847.711-2</br>
                    CL 24 # 18-61</br>
                    Tel: 3114866444 </h2>
            </td>
        </tr>
    </table>

    <table class="info-table center">
        {{-- FECHA Y REMISIÓN --}}
        <tr>
            <td colspan="3" class="green-bg bold">FECHA</td>
            <td rowspan="2" class="green-bg bold">REMISIÓN No</td>
            <td rowspan="2">{{ $numero_remision }}</td>
        </tr>
        <tr>
            <td>{{ $dia }}</td>
            <td>{{ $mes }}</td>
            <td>{{ $año }}</td>
        </tr>

        {{-- CLIENTE --}}
        <tr>
            <td class="green-bg"><strong>SEÑORES</strong></td>
            <td colspan="4">{{ $cliente_nombre }}</td>
        </tr>
        <tr>
            <td class="green-bg"><strong>NIT</strong></td>
            <td colspan="4">{{ $cliente_nit }}</td>
        </tr>
        <tr>
            <td class="green-bg"><strong>DIRECCIÓN</strong></td>
            <td colspan="4">{{ $cliente_direccion }}</td>
        </tr>
        <tr>
            <td class="green-bg"><strong>TELÉFONO</strong></td>
            <td colspan="4">{{ $cliente_telefono }}</td>
        </tr>

        {{-- CONDUCTOR --}}
        <tr class="green-bg bold">
            <td>CONDUCTOR</td>
            <td>TELÉFONO</td>
            <td>CC</td>
            <td colspan="2">PLACA</td>
        </tr>
        <tr>
            <td>{{ $conductor }}</td>
            <td>{{ $tel }}</td>
            <td>{{ $cc }}</td>
            <td colspan="2">{{ $placa }}</td>
        </tr>

        {{-- DETALLES DE MATERIAL --}}
        <tr class="green-bg bold">
            <td>ITEM</td>
            <td colspan="3">DETALLES DEL MATERIAL</td>
            <td>CANTIDAD KG</td>
        </tr>
        @php
            $totalFilas = 18;
            $usadas = count($materiales);
            $faltantes = $totalFilas - $usadas;
        @endphp

        {{-- FILAS CON MATERIALES --}}
        @foreach ($materiales as $i => $m)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td colspan="3" class="bold">{{ $m['detalle'] }}</td>
                <td class="center">{{ $m['cantidad'] }}</td>
            </tr>
        @endforeach

        {{-- FILAS VACÍAS PARA COMPLETAR --}}
        @for ($i = 0; $i < $faltantes; $i++)
            <tr>
                <td class="center"></td>
                <td colspan="3">&nbsp;</td>
                <td class="center">&nbsp;</td>
            </tr>
        @endfor


        {{-- DILIGENCIADOR --}}
        <tr>
            <td class="green-bg bold">DILIGENCIADOR</td>
            <td class="green-bg bold">TELÉFONO</td>
            <td class="green-bg bold">CC</td>
            <td colspan="2" rowspan="2" style="text-align: center;">
            </td>
        </tr>
        <tr>
            <td>{{ $diligenciador }}</td>
            <td>{{ explode('-', $telefono_cc)[0] }}</td>
            <td>{{ explode('-', $telefono_cc)[1] }}</td>
        </tr>

        {{-- OBSERVACIONES Y FIRMAS --}}
        <tr>
            <td colspan="2">
                {{ $observaciones }}<br><br>
                <strong>OBSERVACIONES</strong>
            </td>
            <td class="center">
                <br><br><strong>FIRMA DEL CONDUCTOR</strong>
            </td>
            <td colspan="2" class="center">
                <br><br><strong>FIRMA DEL RECIBIDOR</strong>
            </td>
        </tr>
    </table>

</body>

</html>
