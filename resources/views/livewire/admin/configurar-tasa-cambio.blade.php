<div>

    <div wire:click="$set('open', true)">
        <x-btn-admin-ancho nombre="Actualizar tasa de cambio" icono="img/iconos/pariedad.png" />
    </div>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Actualizar tasa de cambio
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label for="tasa" class="block text-sm font-medium text-gray-700">
                                Tasa de cambio:
                            </label>
                            <input wire:model="tasa.tasa" type="text" name="tasa" id="tasa" class="form-control w-full">
                            <x-jet-input-error for="tasa.tasa" />
                        </div>

                        <div class="col-span-6">
                            <div class="space-y-4">
                                <div class="flex space-x-4 items-center">

                                    <x-select-cantidad />

                                    <x-jet-input type="text" placeholder="Escriba para buscar por fecha..."
                                        class="w-full" wire:model="busqueda" />

                                </div>

                                <!-- tabla -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                @if (count($listaTasas))
                                                    <table class="min-w-full divide-y divide-gray-200">

                                                        <thead class="bg-gray-50">
                                                            <tr>

                                                                <th scope="col"
                                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Fecha
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Tasa
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">

                                                            @foreach ($listaTasas as $item)
                                                                <tr>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            Fecha: {{ Str::substr($item->fecha, 0, 10) }}
                                                                        </div>
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            Hora: {{ Str::substr($item->fecha, 11, 5) }}
                                                                        </div>
                                                                    </td>

                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->tasa }}
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($listaTasas->hasPages())
                                                        <div class="px-6 py-3">
                                                            {{ $listaTasas->links() }}
                                                        </div>
                                                    @endif

                                                @else
                                                    <div class="px-6 py-4">
                                                        Su búsqueda no tuvo resultado
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

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="actualizar" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
