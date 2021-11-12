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
        <h1>Lista de visitas</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha de entrada</th>
                <th>Fecha de salida</th>
                <th>Unidad</th>
                <th>Cédula o RIF</th>
                <th>Nombre</th>
                <th>Número de personas</th>
                <th>Matrícula del vehículo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitas as $item)
                <tr>
                    <td>
                        {{ $item->fecha_hora_entrada }}
                    </td>
                    <td>
                        {{ $item->fecha_hora_salida }}
                    </td>
                    <td>
                        {{ $item->unidad->numero }}
                    </td>
                    <td class="whitespace-nowrap">
                        {{ $item->letra }}-{{ $item->ci }}
                    </td>
                    <td>
                        {{ $item->nombre }}
                        {{ $item->apellido }}
                    </td>
                    <td>
                        {{ $item->numero_personas }}
                    </td>
                    <td>
                        {{ $item->matricula }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
