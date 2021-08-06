@php
$modulos = [
    [
        'name' => 'Banco',
        'route' => route('admin.banco.index'),
    ],
    [
        'name' => 'Categoría',
        'route' => route('admin.categoria.index'),
    ],
    [
        'name' => 'Fondo',
        'route' => route('fondo.index'),
    ],
    // [
    //     'name' => 'Permisos',
    //     'route' => route('proveedor.index'),
    // ],
    [
        'name' => 'Proveedor',
        'route' => route('proveedor.index'),
    ],
    // [
    //     'name' => 'Roles',
    //     'route' => route('servicio.index'),
    // ],
    [
        'name' => 'Servicio',
        'route' => route('admin.servicio.index'),
    ],
    [
        'name' => 'Tipo de Unidad',
        'route' => route('admin.tipo-unidad.index'),
    ],
    [
        'name' => 'Unidad',
        'route' => route('admin.unidad.index'),
    ],
    [
        'name' => 'Usuario',
        'route' => route('admin.usuario'),
    ],
];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div>
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                        <h2 class="text-lg">Datos del sistema</h2>

                        <div class="flex flex-col">
                            @foreach ($modulos as $item)
                                <a href="{{ $item['route'] }}" class="py-2 ml-4">{{ $item['name'] }}</a>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
