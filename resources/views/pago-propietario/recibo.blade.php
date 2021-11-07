<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}" media="print"> --}}
    {{-- <link rel="stylesheet" href="{{ public_path('css/app.css') }}"> --}}

    <style>
        .bg-red-500 {
            background-color: #EF4444;
        }

        .border-1 {
            border: 5px solid aqua;
        }

        .fila {
            background-color: gainsboro;
        }

        .flex {
            display: flex;
        }

        .flex-row {
            flex-direction: row;
        }

        .grid {
            display: grid;
        }

    </style>

<body>
    <div>

        <div class="flex">

            <div>
                <h1>{{ $condominio->nombre }}</h1>
                <h2>Unidad: {{ $pago->unidad->numero }}</h2>
                <h2>Propietario: {{ $pago->unidad->propietario->integrante->nombre }}
                    {{ $pago->unidad->propietario->integrante->apellido }}</h2>
                N°: ####
            </div>

            <div>
                <h1>SGC Web</h1>
            </div>

            <div>
                <img width="40" src="{{ asset('img/logo/negro.png') }}" alt="">
            </div>

        </div>

        <div>
            <h3>Pago aprobado</h3>
            <span>{{ $pago->monto }}</span>
        </div>

    </div>

</body>

</html>
