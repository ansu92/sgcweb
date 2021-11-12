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
        <h1>Lista de proveedores</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Cédula o RIF</th>
                <th>Nombre</th>
                <th>Nombre del contacto</th>
                <th>Teléfono</th>
                <th>Correo electrónico</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $item)
                <tr>
                    <td class="whitespace-nowrap">
                        {{$item->letra}}-{{ $item->documento }}
                    </td>
                    <td>
                        {{ $item->nombre }}
                    </td>
                    <td>
                        {{ $item->contacto }}
                    </td>
                    <td>
                        {{ $item->telefono }}
                    </td>
                    <td>
                        {{ $item->email }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
