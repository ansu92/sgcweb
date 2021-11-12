<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">

<body>
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
                        {{ $item->nombre }}
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
