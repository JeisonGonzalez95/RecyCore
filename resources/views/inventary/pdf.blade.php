<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            left: 20px;
            font-size: 10px;
            color: #777777;
        }

        html,
        body {
            height: 100%;
            margin: 20px;
            padding: 0 30px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .logo {
            float: left;
            width: 100px;
        }

        .title {
            float: right;
            text-align: right;
            font-size: 28px;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 20px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .info {
            margin-top: 40px;
            padding: 10px;
            background-color: #f4f4f4;
        }

        .info p {
            margin: 5px;
            color: #333333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f4f4f4;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: #ffffff;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        .totales-wrapper {
            width: 41%;
            margin-left: auto;
            margin-top: 20px;
        }

        .totales td {
            text-align: right;
            padding: 8px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="clearfix">
            <div class="logo">
                <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="max-width: 100px;">
            </div>
            <div class="title">
                FCT - 00000{{ $moviment->id }}
            </div>
        </div>

        <div class="info">
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($moviment->date_in)->format('d/m/Y') }}</p>
            <p><strong>Cliente:</strong> {{ $moviment->name_client }}</p>
            @if ($isClient == 1)
                <p><strong>Teléfono:</strong> {{ $client->phone }}</p>
                <p><strong>Correo:</strong> {{ $client->email }}</p>
                <p><strong>Dirección:</strong> {{ $client->address }}</p>
            @endif
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($moviment->products as $item)
                    <tr>
                        <td>{{ $item->product->product_name ?? 'Producto desconocido' }}</td>
                        <td>{{ $item->amount_kg }} Kg</td>
                        <td>${{ number_format($item->product->price_product_purch) }}</td>
                        <td>${{ number_format($item->product->price_product_purch * $item->amount_kg) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            $subtotal = $moviment->products->sum(function ($p) {
                return $p->product->price_product_purch * $p->amount_kg;
            });

            $iva = $subtotal * 0.19;
            $total = $subtotal + $iva;
        @endphp

        <div class="totales-wrapper">
            <table class="totales">
                <tr>
                    <td style="width: 80%;"><strong>Subtotal</strong></td>
                    <td>${{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>IVA (19%)</strong></td>
                    <td>${{ number_format($iva, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>TOTAL</strong></td>
                    <td><strong>${{ number_format($total, 0, ',', '.') }}</strong></td>
                </tr>
            </table>
        </div>

    </div>

    <div class="footer">
        <div class="column">
            <strong>Contacto:</strong><br>
            (55) 1234 - 5678<br>
            hola@sitioincreible.com<br>
            www.sitioincreible.com<br>
            Calle Cualquiera 123, Cualquier Lugar
        </div>
    </div>
</body>

</html>
