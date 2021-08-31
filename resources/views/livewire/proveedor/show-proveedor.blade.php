<div wire:init="$set('readyToLoad', true)">
    <div class="bg-white overflow-hidden  shadow-xl rounded-xl">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Proveedor
            </h3>
        </div>

        <div class="border-t border-gray-200">
            <dl>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Documento:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $proveedor->letra . '-' . $proveedor->documento }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Nombre:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $proveedor->nombre }}
                    </dd>
                </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Contacto:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $proveedor->contacto }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Teléfono:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $proveedor->telefono }}
                    </dd>
                </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Email:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 capitalize">
                        {{ $proveedor->email }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Dirección:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 capitalize">
                        {{ $proveedor->direccion }}
                    </dd>
                </div>

            </dl>
        </div>

        <div class="border rounded-md shadow-md m-6 p-6">

            <div class="space-y-4">
                <div class="flex space-x-4 items-center">
                    <x-select-cantidad />

                    <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full"
                        wire:model="busqueda" />

                    @livewire('servicio.nuevo-servicio')
                </div>

                <!-- tabla -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                @if ($readyToLoad)
                                    @if (count($servicios))
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                        wire:click="orden('nombre')">
                                                        Nombre

                                                        @if ($orden == 'nombre')

                                                            @if ($direccion == 'asc')
                                                                <i
                                                                    class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                            @else
                                                                <i
                                                                    class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                            @endif

                                                        @else
                                                            <i class="fas fa-sort float-right mt-1"></i>
                                                        @endif
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                        wire:click="orden('descripcion')">
                                                        Descripción
                                                        @if ($orden == 'descripcion')

                                                            @if ($direccion == 'asc')
                                                                <i
                                                                    class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                            @else
                                                                <i
                                                                    class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                            @endif

                                                        @else
                                                            <i class="fas fa-sort float-right mt-1"></i>

                                                        @endif
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Categoría
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-3">
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($servicios as $item)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->nombre }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->descripcion }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->categoria->nombre }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap space-x-1 text-xs">
                                                            <a href="{{ route('proveedor.show', $item) }}"
                                                                class="btn btn-blue">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a class="btn btn-red"
                                                                wire:click="destroy({{ $item }})">
                                                                <i class="fas fa-minus"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        @if ($servicios->hasPages())
                                            <div class="px-6 py-3">
                                                {{ $servicios->links() }}
                                            </div>
                                        @endif

                                    @else
                                        <div class="px-6 py-4">
                                            Su búsqueda no tuvo resultado
                                        </div>
                                    @endif

                                @else
                                    <div class="px-6 py-4">
                                        Cargando...
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- tabla --}}

            </div>
        </div>
    </div>

    <x-jet-confirmation-modal wire:model="openDestroy">

        <x-slot name="title">
            Remover servicio
        </x-slot>

        <x-slot name="content">
            ¿Seguro que desea remover el servicio?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openDestroy', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="removeServicios" wire:loading.attr="disabled" class="disabled:opacity-25">
                Remover
            </x-jet-danger-button>
        </x-slot>

    </x-jet-confirmation-modal>

</div>
