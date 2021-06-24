@php
    $maestros = [
        [
            'name' => 'Banco',
            'route' => route('banco.index'),
            'active' => request()->routeIs('banco.index'),
        ],
        [
            'name' => 'Proveedor',
            'route' => route('proveedor.index'),
            'active' => request()->routeIs('proveedor.index'),
        ],
        [
            'name' => 'Categoría',
            'route' => route('categoria.index'),
            'active' => request()->routeIs('categoria.index'),
        ],
        [
            'name' => 'Tipo de Unidad',
            'route' => route('tipo-unidad.index'),
            'active' => request()->routeIs('tipo-unidad.index'),
        ],
        [
            'name' => 'Tipo de Usuario',
            'route' => route('tipo-usuario.index'),
            'active' => request()->routeIs('tipo-usuario.index'),
        ],
        [
            'name' => 'Unidad',
            'route' => route('.index'),
            'active' => request()->routeIs('unidad.index'),
        ],
        [
            'name' => 'Usuario',
            'route' => route('usuario'),
            'active' => request()->routeIs('usuario'),
        ],
        [
            'name' => 'Integrante',
            'route' => route('integrante'),
            'active' => request()->routeIs('integrante'),
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
							@foreach($maestros as $item)
								<a href="{{ $item['route'] }}" class="py-2 ml-4">{{ $item['name'] }}</a>
							@endforeach
						</div>
						
					</div>
				</div>

            </div>
        </div>
    </div>
</x-app-layout>
