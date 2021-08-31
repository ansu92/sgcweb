<div class="space-y-4">
    <div class="flex space-x-4 items-center">

        @if (count($listaServicios))
            @if ($listaServicios->hasPages())
                <x-select-cantidad />
            @endif
        @endif

        <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />
    </div>

    <!-- tabla -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

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

                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                @endif

                                            @else
                                                <i class="fas fa-sort float-right mt-1"></i>

                                            @endif
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            wire:click="orden('apellido')">
                                            Categoría
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                            <input wire:model="selectPage" type="checkbox" name="selectPage"
                                                id="selectPage" class="form-control">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if ($selectPage)
                                        <tr>
                                            <td colspan="5" class=" text-sm px-6 py-4 whitespace-nowrap bg-gray-200">

                                                @unless($selectAll)
                                                    <div>
                                                        <span>Ha seleccionado
                                                            <strong>{{ count($servicios) }}</strong>
                                                            personas. ¿Quiere seleccionar a
                                                            todos los
                                                            <strong>{{ $listaServicios->total() }}</strong>
                                                            servicios?</span>


                                                        <button class="text-blue-500" wire:click="$set('selectAll', true)">
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
                                            <td class="px-6 py-4 whitespace-nowrap text-xs space-x-1 font-medium">
                                                <input type="checkbox" value="{{ $item->id }}" class="form-control"
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
