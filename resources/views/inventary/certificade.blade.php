<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado Recolección</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            margin-top: 0;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 100px;
        }

        .certificate-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
            text-transform: uppercase;
        }

        .certificate-number {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
            font-size: 12px;
        }

        .content {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .table-title {
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }

        .footer {
            margin-top: 40px;
        }

        .signature img {
            margin-bottom: -50px;
        }

        .signature {
            text-align: center;
            font-size: 12px;
            margin-top: 40px;
        }


        .signature-name {
            font-weight: bold;
            margin-top: 10px;
        }

        .contact {
            font-size: 12px;
            margin-top: 20px;
        }

        .top-img {
            margin-top: -60 !important;
            margin-left: -80 !important;
            display: flex;
        }

        .top-img img {
            width: 150px;
        }

        .top-text {
            text-align: center;
            font-size: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: -140px;
            margin-bottom: 50px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 2% auto;
        }

        thead {
            background-color: #93c47d;
            color: #ffffff;
            font-weight: bold;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 3px;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f9f2;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
    </style>

</head>

<body>
    <div class="top-img">
        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logo_recyplus.png'))) }}"
            alt="Logo Recyplus">
    </div>

    <div class="top-text">
        <b>ASOCIACION DE RECICLADORES <br> RECYPLUS </b> <br>
        Reciclar está en tus manos
    </div>

    <div class="header">
        <div class="certificate-title">CERTIFICADO DE RECOLECCIÓN,<br> TRATAMIENTO Y DISPOSICIÓN <br>FINAL DE RESIDUOS
        </div>
        <div class="certificate-number">Certificado No. {{ $no_cert }}</div>
    </div>

    <div class="content">
        <p>Certifica que la entidad <b>{{ $entidad }}</b> con NIT
            <b>{{ $nit }}</b> entregó para tratamiento y disposición final los residuos aprovechables el día
            <b>{{ $fecha }}</b>, los cuales se relacionan de la siguiente manera:
        </p>
    </div>

    <div class="table-title">MATERIALES ENTREGADOS</div>
    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>TIPO DE RESIDUO</th>
                    <th>CANTIDAD (KG)</th>
                    <th>TRATAMIENTO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiales as $material)
                    <tr>
                        <td>{{ $material['item'] }}</td>
                        <td>{{ $material['producto'] }}</td>
                        <td>{{ $material['cantidad'] }}</td>
                        <td>DISPOSICIÓN FINAL</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Agradecemos habernos tenido en cuenta para llevar a cabo el proceso de aprovechamiento y disposición final de
            los diferentes residuos generados por su compañía. Nuestras instalaciones se encuentran ubicadas en la
            <b>Calle
                24 #18–61 Barrio Santa Fe</b>. Para más información, comuníquese al <b>3114866444</b> o al correo <a
                href="mailto:recyplusrcp@gmail.com">recyplusrcp@gmail.com</a>.</p>
        <p>La presente certificación se expide a los días <b>{{$fecha_certificado}}</b>.</p>
    </div>

    <div class="signature">
        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/signatures/daniel.png'))) }}"
            alt="Firma Gerente General">
        <div class="signature-name">
            ___________________________________ <br>
            JOJHAN DANIEL CAICEDO MURILLO
        </div>
        <div>GERENTE GENERAL RECYPLUS</div>
    </div>

</body>

</html>
