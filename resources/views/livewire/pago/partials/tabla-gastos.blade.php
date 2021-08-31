<div class="space-y-4">
    <div class="flex space-x-4 items-center">
        <x-select-cantidad />

        <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />
    </div>

    {{-- tabla --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    @if (count($gastos))
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descripción
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Proveedor
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Monto
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Saldo restante
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    {{-- <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Acciones</span>
                                </th> --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($gastos as $item)
                                    <tr wire:click="mostrarForm({{ $item }})"
                                        class="cursor-pointer hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->descripcion }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->proveedor->nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->monto }}

                                            @switch($item->moneda)
                                                @case('Bolívar')
                                                    Bs.
                                                @break
                                                @case('Dólar')
                                                    $
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->saldo }}

                                            @switch($item->moneda)
                                                @case('Bolívar')
                                                    Bs.
                                                @break
                                                @case('Dólar')
                                                    $
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($item->extraordinario)
                                                Extraordinario
                                            @else
                                                Ordinario
                                            @endif
                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                        <a class="btn btn-blue">
                                            Pagar
                                            <i class="fas fa-"></i>
                                        </a>
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="px-6 py-4">
                            Su búsqueda no tuvo resultado
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- /table --}}

</div>
