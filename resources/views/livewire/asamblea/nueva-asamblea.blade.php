<div wire:init="loadIntegrantes">

    <x-jet-button wire:click="$set('abierto', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="abierto" maxWidth='4xl'>
        <x-slot name="title">
            Nueva asamblea
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">

                                <label for="descripcion"
                                    class="block text-sm font-medium text-gray-700">Descripción:</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="descripcion" id="descripcion"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        wire:model="descripcion">
                                </div>
                                <x-jet-input-error for="descripcion" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="fecha" class="block text-sm font-medium text-gray-700"> Fecha:</label>
                                <input type="date" name="fecha" id="fecha" autocomplete="street-address"
                                    class="form-control w-full" wire:model="fecha">
                                <x-jet-input-error for="fecha" />
                            </div>

                            <div class="col-span-6">
                                <label for="observacion"
                                    class="block text-sm font-medium text-gray-700">Observación:</label>
                                <textarea name="observacion" class="form-control w-full" cols="30" rows="5"
                                    wire:model="observacion"></textarea>
                                <x-jet-input-error for="observacion" />
                            </div>

                            <div class="col-span-6">
                                <x-jet-input-error for="asistentes" />

                                <div class="space-y-4">
                                    <div class="flex space-x-4 items-center">

                                        <x-select-cantidad />

                                        <x-jet-input type="text" placeholder="Escriba para buscar..."
                                            class="w-full" wire:model="busqueda" />

                                    </div>

                                    <!-- tabla -->
                                    <div class="flex flex-col">
                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                <div
                                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                    @if ($readyToLoad)
                                                        @if (count($integrantes))
                                                            <table class="min-w-full divide-y divide-gray-200">

                                                                <thead class="bg-gray-50">
                                                                    <tr>

                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                                            wire:click="orden('documento')">
                                                                            Documento

                                                                            @if ($orden == 'documento')

                                                                                @if ($direccion == 'asc')
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
                                                                                <i
                                                                                    class="fas fa-sort float-right mt-1"></i>

                                                                            @endif
                                                                        </th>
                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                                            wire:click="orden('apellido')">
                                                                            Apellido

                                                                            @if ($orden == 'apellido')

                                                                                @if ($direccion == 'asc')
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
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                            Unidad
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
                                                                                            <strong>{{ count($asistentes) }}</strong>
                                                                                            personas. ¿Quiere seleccionar a
                                                                                            todas las
                                                                                            <strong>{{ $integrantes->total() }}</strong>
                                                                                            personas?</span>


                                                                                        <button class="text-blue-500"
                                                                                            wire:click="$set('selectAll', true)">
                                                                                            Seleccionar todo
                                                                                        </button>
                                                                                    </div>
                                                                                @else

                                                                                    <span>Ha seleccionado
                                                                                        <strong>{{ $integrantes->total() }}</strong>
                                                                                        personas</span>

                                                                                @endunless

                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    @foreach ($integrantes as $item)
                                                                        <tr>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    @if($item->documento)
																					{{ $item->letra }}-{{ $item->documento }}
																					@endif
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $item->nombre }}
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $item->apellido }}
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $item->unidad->numero }}
                                                                                </div>
                                                                            </td>
                                                                            <td
                                                                                class="px-6 py-4 whitespace-nowrap text-xs space-x-1 font-medium">
                                                                                <input type="checkbox"
                                                                                    {{-- name="check_integrante_{{ $item->id }}"
                                                                                    id="check_integrante_{{ $item->id }}" --}}
                                                                                    value="{{ $item->id }}"
                                                                                    class="form-control"
                                                                                    wire:model="asistentes">

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            @if ($integrantes->hasPages())
                                                                <div class="px-6 py-3">
                                                                    {{ $integrantes->links() }}
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

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                {{-- /formulario --}}
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('abierto', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="save()" wire:loading.attr="disabled">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
