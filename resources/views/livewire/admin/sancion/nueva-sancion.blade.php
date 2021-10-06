<div wire:init="$set('readyToLoad', true)">

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open" maxWidth='2xl'>
        <x-slot name="title">
            Nueva sanción
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 ">

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

                                <label for="monto"
                                    class="block text-sm font-medium text-gray-700">Monto:</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="monto" id="monto"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        wire:model="monto">
                                </div>
                                <x-jet-input-error for="monto" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <label for="moneda" class="block text-sm font-medium text-gray-700">
                                        Moneda:
                                    </label>
                                    <select wire:model="moneda" name="moneda" id="moneda" class="form-control w-full">
                                        <option>Bolívar</option>
                                        <option>Dólar</option>
                                    </select>
                                </div>
                                <x-jet-input-error for="moneda" />
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /formulario --}}
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="save()" wire:loading.attr="disabled">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
