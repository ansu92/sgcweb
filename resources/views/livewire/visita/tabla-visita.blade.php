<div wire:init="$set('readyToLoad', true)">
    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input type="search" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('visita.nueva-visita')
        </div>

        <!-- tabla -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        @if ($readyToLoad)
                            @if (count($visitas))
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                wire:click="orden('fecha_hora_entrada')">
                                                Fecha
                                                @if ($orden == 'fecha_hora_entrada')

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
                                                wire:click="orden('ci')">
                                                Documento

                                                @if ($orden == 'ci')

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
                                                wire:click="orden('apellido')">
                                                Apellido
                                                @if ($orden == 'apellido')

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
                                                Vehículo
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Número de personas
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($visitas as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->fecha_hora_entrada }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->letra . '-' . $item->ci }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->nombre }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->apellido }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        @if($item->matricula) Sí @else No @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->numero_personas }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap space-x-1 text-xs">
                                                    <a href="{{ route('proveedor.show', $item) }}"
                                                        class="btn btn-blue">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
													<button wire:click="registrarSalida({{$item}})" class="btn btn-green">
														Registrar salida
													</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if ($visitas->hasPages())
                                    <div class="px-6 py-3">
                                        {{ $visitas->links() }}
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
