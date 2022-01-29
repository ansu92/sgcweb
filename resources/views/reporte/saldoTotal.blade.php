<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">

<body>

    <div>
        Condominio: <span>{{ $condominio->nombre }}</span>
        <br>
        <span>Fecha: {{ substr(today(), 0, 10) }}</span>
    </div>

    <div class="absolute" style="top: 0px; right: 0px;">
        <span style="font-size: 2rem">SGC Web</span>

        <div class="bg-azul p-2 relative" style="height: 50px; width: 50px; border-radius: 30px; left:35px">
            <img width="50" height="50" src="{{ asset('img/logo/blanco.png') }}" alt="">
        </div>
    </div>

    <div class="text-center">
        <h1>Lista de fondos y saldo total</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Saldo</th>
                <th>Moneda</th>
                <th>Cuenta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fondos as $item)
                <tr>
                    <td>
                        {{ $item->descripcion }}
                    </td>
                    <td>
                        {{ $item->moneda }}
                    </td>
                    <td>
                        {{ $item->saldo }}
                    </td>
                    <td>
                        @if ($item->cuenta)
                            {{ $item->cuenta->numeroOculto }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <th>Saldo en efectivo</th>
                <td>{{$fondos->whereNull('cuenta_id')->sum('saldo')}}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <th>Saldo digital</th>
                <td>{{$fondos->whereNotNull('cuenta_id')->sum('saldo')}}</td>
            </tr>
            <tr>
                <td colspan="2" border="2" style="border: 0px;"></td>
                <th>Total</th>
                <td>{{$fondos->sum('saldo')}}</td>
            </tr>
    </tfoot>
    </table>
</body>

</html>
