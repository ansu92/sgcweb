<div wire:init="$set('readyToLoad', true)">
    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input wire:model="busqueda" type="text" placeholder="Escriba para buscar..." class="w-full" />

            <a href="{{ route('pago-propietario.create') }}">
                <button class="btn btn-blue w-44">Pagar gasto</button>
            </a>
        </div>

        {{-- tabla --}}
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        @if ($readyToLoad)
                            @if (count($pagos))
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Descripción
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Monto
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Fecha
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Recibo
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Factura
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Unidad
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Acciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($pagos as $pago)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pago->descripcion }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pago->montoFormateado }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pago->fecha }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pago->recibo }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pago->factura->id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $pago->unidad->numero }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                                    <a href="{{ route('pago-propietario.show', $pago) }}"
                                                        class="btn btn-blue">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($pagos->hasPages())
                                    <div class="px-6 py-3">
                                        {{ $pagos->links() }}
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
        {{-- /table --}}

    </div>
</div>
