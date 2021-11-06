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
        <h1>Lista de categorías</h1>
    </div>

    <table class="" border="4">
        <thead class="">
            <tr class="">
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody class="">
            @foreach ($cuentas as $item)
                <tr class="">
                    <td class="">
                        {{ $item->numero }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
