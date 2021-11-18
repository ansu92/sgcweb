<div>

    <div wire:click="$set('open', true)">
        <x-btn-admin-ancho nombre="Actualizar mensualidad" icono="img/iconos/mensualidad.png" />
    </div>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Actualizar mensualidad
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label for="monto" class="block text-sm font-medium text-gray-700">
                                Monto:
                            </label>
                            <input wire:model="monto" type="text" name="monto" id="monto" class="form-control w-full">
                            <x-jet-input-error for="monto" />
                        </div>

                        <div class="col-span-6">
                            <label for="moneda" class="block text-sm font-medium text-gray-700">
                                Moneda:
                            </label>
                            <select wire:model="moneda" name="moneda" id="moneda" class="form-control w-full">
                                <option>Bolívar</option>
                                <option>Dólar</option>
                            </select>
                            <x-jet-input-error for="moneda" />
                        </div>

                        <div class="col-span-6">
                            <x-jet-input-error for="asistentes" />

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
                                                @if (count($mensualidades))
                                                    <table class="min-w-full divide-y divide-gray-200">

                                                        <thead class="bg-gray-50">
                                                            <tr>

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
                                                                    Moneda
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">

                                                            @foreach ($mensualidades as $item)
                                                                <tr>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->fecha }}
                                                                        </div>
                                                                    </td>

                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->monto }}
                                                                        </div>
                                                                    </td>

                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->moneda }}
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($mensualidades->hasPages())
                                                        <div class="px-6 py-3">
                                                            {{ $mensualidades->links() }}
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
