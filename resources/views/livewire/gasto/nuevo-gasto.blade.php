<div wire:init="$set('readyToLoad', true)">

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">

        <x-slot name="title">
            Nuevo gasto
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="mt-10 sm:mt-0">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-6">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                    Descripción:
                                </label>
                                <input wire:model.lazy="descripcion" type="text" name="descripcion" id="descripcion"
                                    class="form-control w-full">
                                <x-jet-input-error for="descripcion" />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="tipo" class="block text-sm font-medium text-gray-700">
                                    Tipo de gasto:
                                </label>
                                <div>
                                    <input wire:model="tipo" type="radio" name="tipo" id="ordinario" value="ordinario">
                                    <label for="ordinario">Ordinario</label>
                                </div>
                                <div>
                                    <input wire:model="tipo" type="radio" name="tipo" id="extraordinario"
                                        value="extraordinario">
                                    <label for="extraordinario">Extraordinario</label>
                                </div>
                                <x-jet-input-error for="tipo" />
                            </div>

                            @if ($tipo == 'extraordinario')
                                <div class="col-span-6 sm:col-span-2">
                                    <label for="numero-meses" class="block text-sm font-medium text-gray-700">
                                        Número de meses:
                                    </label>
                                    <input wire:model.lazy="numeroMeses" type="number" name="numero-meses"
                                        id="numero-meses" class="form-control w-full">
                                    <x-jet-input-error for="numeroMeses" />
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="elegido-asamblea" class="block text-sm font-medium text-gray-700">
                                        ¿El gasto fue decidio en una asamblea?
                                    </label>
                                    <div>
                                        <input wire:model="elegidoAsamblea" type="radio" name="elegido-asamblea" id="si"
                                            value="si">
                                        <label for="si">Sí</label>
                                        <input wire:model="elegidoAsamblea" type="radio" name="elegido-asamblea" id="no"
                                            value="no" class="ml-2">
                                        <label for="no">No</label>
                                    </div>
                                    <x-jet-input-error for="elegidoAsamblea" />
                                </div>

                                @if ($elegidoAsamblea == 'si')
                                    <div class="col-span-6">
                                        <label for="asamblea" class="block text-sm font-medium text-gray-700">
                                            Asamblea:
                                        </label>
                                        <select wire:model="asamblea.id" name="asamblea" id="asamblea"
                                            class="form-control w-full">
                                            <option value="0"> -- </option>
                                            @foreach ($asambleas as $item)
                                                <option value="{{ $item->id }}">{{ $item->fecha }} - {{ $item->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <x-jet-input-error for="asamblea.id" />
                                    </div>
                                @endif
                            @endif

                            <div class="col-span-6 sm:col-span-3">
                                <label for="calculo" class="block text-sm font-medium text-gray-700">
                                    Calcular por:
                                </label>
                                <div>
                                    <select wire:model="calculo" name="calculo" id="calculo"
                                        class="form-control w-full">
                                        <option>--</option>
                                        <option>Alícuota</option>
                                        <option>Total de inmuebles</option>
                                    </select>
                                </div>
                                <x-jet-input-error for="calculo" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="comienzo-cobro" class="block text-sm font-medium text-gray-700">
                                    Comienzo de cobro:
                                </label>
                                <input wire:model="comienzoCobro" type="month" name="comienzo-cobro" id="comienzo-cobro"
                                    class="form-control w-full">
                                <x-jet-input-error for="comienzoCobro" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="moneda" class="block text-sm font-medium text-gray-700">
                                    Moneda:
                                </label>
                                <select wire:model="moneda" name="moneda" id="moneda" class="form-control w-full">
                                    <option>Bolívar</option>
                                    <option>Dólar</option>
                                </select>
                                <x-jet-input-error for="moneda" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="monto" class="block text-sm font-medium text-gray-700">
                                    Monto total:
                                </label>
                                <input wire:model="monto" type="text" name="monto" id="monto" readonly
                                    class="form-control w-full">
                                <x-jet-input-error for="monto" />
                            </div>

                            <div class="col-span-6">
								<label for="observaciones" class="block text-sm font-medium text-gray-700">
									Observaciones:
                                </label>
                                <textarea wire:model.lazy="observaciones" name="observaciones" id="observaciones"
								rows="5" class="form-control w-full"></textarea>
                                <x-jet-input-error for="observaciones" />
                            </div>

                            <div class="col-span-6">
                                {{-- <label class="block text-sm font-medium text-gray-700">Servicios</label> --}}
                                <x-jet-input-error for="servicios" />

                                <div class="space-y-4">
                                    <div class="flex space-x-4 items-center">
                                        <x-select-cantidad />

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
                                                                                <i
                                                                                    class="fas fa-sort float-right mt-1"></i>

                                                                            @endif
                                                                        </th>
                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                            Categoría
                                                                        </th>
                                                                        <th scope="col"
                                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                            Monto
                                                                        </th>
                                                                        <th scope="col" class="relative px-6 py-3">
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
                                                                                            servicios. ¿Quiere seleccionar a
                                                                                            todos las
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
                                                                                        personas
																					</span>

                                                                                @endunless

                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    @foreach ($listaServicios as $key => $item)
                                                                        <tr>
                                                                            <td class="px-6 py-4 whitespace-nowrap">
																				{{$item->id}}
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
                                                                            <td class="px-6 py-4">
                                                                                <div
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    <input wire:model.lazy="montos.{{ $item->id }}"
                                                                                        type="number"
                                                                                        class="form-control">
																					<x-jet-input-error for="montos.{{ $item->id }}" />
                                                                                </div>
                                                                            </td>
                                                                            <td
                                                                                class="px-6 py-4 whitespace-nowrap space-x-1 text-xs">
                                                                                <input wire:model="servicios.{{ $item->id }}"
                                                                                    type="checkbox"
                                                                                    value="{{ $item->id }}"
                                                                                    class="form-control">
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
            </div>
            {{-- /formulario --}}

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="save" wire:loading.attr="disabled" class="disabled:bg-opacity-25">
                Registrar
            </x-jet-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
