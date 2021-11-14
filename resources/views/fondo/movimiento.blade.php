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
        <h1>Lista de movimientos</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $item)
                <tr>
                    <td>
                        {{ $item->tipo }}
                    </td>
                    @if ($item->tipo == 'Crédito')
                        <td>
                            {{ $item->monto }}
                        </td>
                    @else
                        <td class="text-red-500">
                            -{{ $item->monto }}
                        </td>
                    @endif
                    <td>
                        {{ $item->fecha }}
                    </td>
                    <td>
                        {{ $item->descripcion }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
