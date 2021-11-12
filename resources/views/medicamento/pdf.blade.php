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
        <h1>Lista de medicamentos</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicamentos as $item)
                <tr>
                    <td>
                        {{ $item->nombre }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
