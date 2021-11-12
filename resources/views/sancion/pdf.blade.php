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
        <h1>Lista de sanciones</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Moneda</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sanciones as $item)
                <tr>
                    <td>
                        {{ $item->descripcion }}
                    </td>
                    <td>
                        {{ $item->monto }}
                    </td>
                    <td>
                        {{ $item->moneda }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
