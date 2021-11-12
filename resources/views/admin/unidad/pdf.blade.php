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
        <h1>Lista de unidades</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Propietario</th>
                <th>Dirección</th>
                <th>Tipo de unidad</th>
                <th>Área</th>
                <th>Número de habitantes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unidades as $item)
                <tr>
                    <td>
                        {{ $item->numero }}
                    </td>
                    <td>
                        @if ($item->propietario)
                            {{ $item->propietario->integrante->nombre }}
                            {{ $item->propietario->integrante->apellido }}
                        @endif
                    </td>
                    <td>
                        {{ $item->direccion }}
                    </td>
                    <td>
                        {{ $item->tipoUnidad->nombre }}
                    </td>
                    <td class="whitespace-nowrap">
                        {{ $item->tipoUnidad->area }} m2
                    </td>
                    <td>
                        {{ $item->integrantes->count() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
