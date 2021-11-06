<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">

<body>
    <div>
        <h1>{{ $titulo }}</h1>
    </div>

    <table class="" border="4">
        <thead class="">
            <tr class="">
                <th>Número</th>
                <th>Dirección</th>
                <th>Tipo</th>
                <th>Área</th>
            </tr>
        </thead>
        <tbody class="">
            @foreach ($unidades as $item)
                <tr class="">
                    <td class="">
                        {{ $item->numero }}
                    </td>
                    <td class="">
                        {{ $item->direccion }}
                    </td>
                    <td class="">
                        {{ $item->tipoUnidad->nombre }}
                    </td>
                    <td class="">
                        {{ $item->tipoUnidad->area }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
