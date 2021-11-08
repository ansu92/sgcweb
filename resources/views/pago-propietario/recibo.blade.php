<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/pdf.css">

    <style>

    </style>

<body>

    <div>
        Condominio: <span>{{ $condominio->nombre }}</span>
        <br>
        <span>Unidad: {{ $recibo->pago->unidad->numero }}</span>
        <br>
        <span>Propietario: {{ $recibo->pago->unidad->propietario->integrante->nombre }}
            {{ $recibo->pago->unidad->propietario->integrante->apellido }}</span>
    </div>

    <div class="absolute" style="top: 0px; right: 0px;">
        <span style="font-size: 2rem">SGC Web</span>

        <div class="bg-azul p-2 relative" style="height: 50px; width: 50px; border-radius: 30px; left:35px">
            <img width="50" height="50" src="{{ asset('img/logo/blanco.png') }}" alt="">
        </div>
    </div>

    <h2 style="text-align: center">Recibo de pago</h2>

    <div class="p-2" style="margin-top: 20px; border: 1px solid black">
        <span>N°: {{ $recibo->numero }}</span>
        <h2>Pago aprobado</h2>
        <span>Monto: {{ $recibo->pago->monto }}</span>
    </div>
    </div>

</body>

</html>
