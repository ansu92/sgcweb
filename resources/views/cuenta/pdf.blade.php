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
        <h1>Lista de cuentas bancarias del condominio</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Tipo</th>
                <th>Cédula o RIF</th>
                <th>Nombre del beneficiario</th>
                <th>Banco</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $item)
                <tr>
                    <td>
                        {{ $item->numero }}
                    </td>
                    <td>
                        {{ $item->tipo }}
                    </td>
                    <td class="whitespace-nowrap">
                        {{ $item->documento }}
                    </td>
                    <td>
                        {{ $item->beneficiario }}
                    </td>
                    <td>
                        {{ $item->banco->nombre }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
