@php
$modulos = [
    [
        'name' => 'Bancos',
        'route' => route('banco.index'),
    ],
    [
        'name' => 'Cuentas bancarias',
        'route' => route('cuenta.index'),
    ],
    [
        'name' => 'Categorías',
        'route' => route('categoria.index'),
    ],
    // [
    //     'name' => 'Permisos',
    //     'route' => route('proveedor.index'),
    // ],
    // [
    //     'name' => 'Roles',
    //     'route' => route('servicio.index'),
    // ],
    [
        'name' => 'Servicios',
        'route' => route('servicio.index'),
    ],
    [
        'name' => 'Tipos de unidad',
        'route' => route('tipo-unidad.index'),
    ],
    [
        'name' => 'Unidades',
        'route' => route('admin.unidad.index'),
    ],
    [
        'name' => 'Usuarios',
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

				<div class="flex flex-col p-4 gap-3">

					<a href="">
						<x-card-condominio />
					</a>

					<a href="{{route('admin.unidad.index')}}">
						<div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
							Lista de unidades
						</div>
					</a>

					<a href="{{route('pago.create')}}">
						<div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
							Pagar gastos
						</div>
					</a>

					<a href="{{route('comunicado.index')}}">
						<div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
							Comunicados
						</div>
					</a>

					<a href="{{route('gasto.index')}}">
						<div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
							Registrar gastos
						</div>
					</a>

				</div>

                {{-- <div>
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                        <h2 class="text-lg">Datos del sistema</h2>

                        <div class="flex flex-col">
                            @foreach ($modulos as $item)
                                <a href="{{ $item['route'] }}" class="py-2 ml-4">{{ $item['name'] }}</a>
                            @endforeach
                        </div>

                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</x-app-layout>
