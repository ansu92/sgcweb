<h3 class="my-2 block text-lg text-center text-gray-900">Puede actualizar los montos de los servicios</h3>

<div class="space-y-4">

    <!-- tabla -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    @if ($readyToLoadEdit)
                        @if (count($gasto->servicios))
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                            wire:click="orden('nombre')">
                                            Nombre

                                            @if ($orden == 'nombre')

                                                @if ($direccion == 'asc')
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

                                                @if ($direccion == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                @endif

                                            @else
                                                <i class="fas fa-sort float-right mt-1"></i>

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
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($gasto->servicios as $item)
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
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <input wire:model="montos.{{ $item->id }}" type="text"
                                                        class="form-control w-36">
                                                    <x-jet-input-error for="montos.{{ $item->id }}" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- @if ($listaServicios->hasPages())
                                <div class="px-6 py-3">
                                    {{ $listaServicios->links() }}
                                </div>
                            @endif --}}

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
