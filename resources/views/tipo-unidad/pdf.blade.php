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
        <h1>Lista de tipos de unidad</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Área</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiposUnidad as $item)
                <tr>
                    <td>
                        {{ $item->nombre }}
                    </td>
                    <td>
                        {{ $item->area }} m2
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
