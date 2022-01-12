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
        <h1>Lista de habitantes del condominio</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo electrónico</th>
                <th>Unidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($habitantes as $item)
                <tr>
                    <td class="whitespace-nowrap">
                        {{$item->letra}}-{{ $item->documento }}
                    </td>
                    <td>
                        {{ $item->nombre }} {{ $item->apellido }}
                    </td>
                    <td class="whitespace-nowrap">
                        {{ $item->telefono }}
                    </td>
                    <td>
                        {{ $item->email }}
                    </td>
                    <td>
                        {{ $item->unidad->numero }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
