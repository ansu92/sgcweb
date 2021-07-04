<div wire:init="$set('readyToLoad', true)">

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
        <x-slot name="title">
            Nuevo proveedor
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-2">
                                <label for="documento" class="block text-sm font-medium text-gray-700">Documento</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select id="letra" name="letra"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                            wire:model="letra">
                                            <option>V</option>
                                            <option>E</option>
                                            <option>J</option>
                                        </select>
                                    </div>
                                    <input type="text" name="numero_documento" id="numero_documento"
                                        class="form-control block w-full pl-12" placeholder="Cédula o RIF"
                                        wire:model="documento">
                                </div>
                                <x-jet-input-error for="letra" />
                                <x-jet-input-error for="documento" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input wire:model="nombre" type="text" name="nombre" id="nombre"
                                    class="form-control w-full">
                                <x-jet-input-error for="nombre" />
                            </div>

                            <div class="col-span-3">
                                <label for="contacto" class="block text-sm font-medium text-gray-700">Contacto</label>
                                <input wire:model="contacto" type="text" name="contacto" id="contacto"
                                    class="form-control w-full">
                                <x-jet-input-error for="contacto" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="tel" name="telefono" id="telefono" pattern="\d{4}-\d{7}"
                                    class="form-control w-full"
                                    wire:model="telefono">
                                <small class="text-xs text-gray-600">Formato: 0412-1234567</small>
                                <x-jet-input-error for="telefono" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" autocomplete="email"
                                    class="form-control w-full"
                                    wire:model="email">
                                <x-jet-input-error for="email" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <input type="text" name="direccion" id="direccion"
                                    class="form-control w-full"
                                    wire:model="direccion">
                                <x-jet-input-error for="direccion" />
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm font-medium text-gray-700">Servicios:</label>
								<x-jet-input-error for="servicios" />
                                <div class="space-y-4">
                                    <div class="flex space-x-4 items-center">

                                        @if (count($listaServicios))
                                            @if ($listaServicios->hasPages())
                                                <x-select-cantidad />
                                            @endif
                                        @endif

                                        <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full"
                                            wire:model="busqueda" />
                                    </div>

                                    <!-- tabla -->
                                    <div class="flex flex-col">
                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                <div
                                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                    @if ($readyToLoad)
                                                        @if (count($listaServicios))
                                                            <table class="min-w-full divide-y divide-gray-200">

                                                                <thead class="bg-gray-50">
                                                                    <tr>

                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                                            wire:click="orden('nombre')">
                                                                            Nombre

                                                                            @if ($orden == 'nombre')

                                                                                @if ($direction == 'asc')
                                                                                    <i
                                                                                        class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                                                @else
                                                                                    <i
                                                                                        class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                                                @endif

                                                                            @else
                                                                                <i
                                                                                    class="fas fa-sort float-right mt-1"></i>

                                                                            @endif
                                                                        </th>

                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                                            wire:click="orden('descripcion')">
                                                                            Descripción

                                                                            @if ($orden == 'descripcion')

                                                                                @if ($direction == 'asc')
                                                                                    <i
                                                                                        class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                                                @else
                                                                                    <i
                                                                                        class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                                                @endif

                                                                            @else
                                                                                <i
                                                                                    class="fas fa-sort float-right mt-1"></i>

                                                                            @endif
                                                                        </th>
                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                                            wire:click="orden('apellido')">
                                                                            Categoría
                                                                        </th>
                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                                                            <input wire:model="selectPage"
                                                                                type="checkbox" name="selectPage"
                                                                                id="selectPage" class="form-control">

                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="bg-white divide-y divide-gray-200">
                                                                    @if ($selectPage)
                                                                        <tr>
                                                                            <td colspan="5"
                                                                                class=" text-sm px-6 py-4 whitespace-nowrap bg-gray-200">

                                                                                @unless($selectAll)
                                                                                    <div>
                                                                                        <span>Ha seleccionado
                                                                                            <strong>{{ count($servicios) }}</strong>
                                                                                            personas. ¿Quiere seleccionar a
                                                                                            todos los
                                                                                            <strong>{{ $listaServicios->total() }}</strong>
                                                                                            servicios?</span>


                                                                                        <button class="text-blue-500"
                                                                                            wire:click="$set('selectAll', true)">
                                                                                            Seleccionar todo
                                                                                        </button>
                                                                                    </div>
                                                                                @else

                                                                                    <span>Ha seleccionado
                                                                                        <strong>{{ $listaServicios->total() }}</strong>
                                                                                        servicios</span>

                                                                                @endunless

                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    @foreach ($listaServicios as $item)
                                                                        <tr>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $item->nombre }}
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-6 py-4">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $item->descripcion }}
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $item->categoria->nombre }}
                                                                                </div>
                                                                            </td>
                                                                            <td
                                                                                class="px-6 py-4 whitespace-nowrap text-xs space-x-1 font-medium">
                                                                                <input type="checkbox"
                                                                                    value="{{ $item->id }}"
                                                                                    class="form-control"
                                                                                    wire:model="servicios">

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            @if ($listaServicios->hasPages())
                                                                <div class="px-6 py-3">
                                                                    {{ $listaServicios->links() }}
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
                                    {{-- /tabla --}}

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                {{-- /formulario --}}

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="save()" wire:loading.attr="disabled" class="disabled:opacity-25">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
