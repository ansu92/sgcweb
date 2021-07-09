<div wire:init="$set('readyToLoad', true)">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('gasto.nuevo-gasto')
        </div>

        {{-- tabla --}}
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                        Tipo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($gastos as $gasto)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $gasto->descripcion }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $gasto->monto }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($gasto->extraordinario)
                                                Extraordinario
                                            @else
                                                Ordinario
                                            @endif
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $gasto->estado }}
                                        </td>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                            <a href="{{ route('gasto.show', $gasto) }}" class="btn btn-blue">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- /table --}}

    </div>

</div>
