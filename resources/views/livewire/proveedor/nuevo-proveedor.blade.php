<div wire:init="$set('readyToLoad', true)">

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">

        <x-slot name="title">
            Nuevo proveedor
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="mt-10 sm:mt-0">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-2">
                                <label for="documento" class="block text-sm font-medium text-gray-700">Documento</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select id="letra" name="letra"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                            wire:model="letra">
                                            <option>V</option>
                                            <option>E</option>
                                            <option>J</option>
                                        </select>
                                    </div>
                                    <input type="text" name="numero_documento" id="numero_documento"
                                        class="form-control block w-full pl-12" placeholder="Cédula o RIF"
                                        wire:model="documento">
                                </div>
                                <x-jet-input-error for="letra" />
                                <x-jet-input-error for="documento" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input wire:model="nombre" type="text" name="nombre" id="nombre"
                                    class="form-control w-full">
                                <x-jet-input-error for="nombre" />
                            </div>

                            <div class="col-span-3">
                                <label for="contacto" class="block text-sm font-medium text-gray-700">Contacto</label>
                                <input wire:model="contacto" type="text" name="contacto" id="contacto"
                                    class="form-control w-full">
                                <x-jet-input-error for="contacto" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input type="tel" name="telefono" id="telefono" pattern="\d{4}-\d{7}"
                                    class="form-control w-full" wire:model="telefono">
                                <small class="text-xs text-gray-600">Formato: 0412-1234567</small>
                                <x-jet-input-error for="telefono" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" autocomplete="email"
                                    class="form-control w-full" wire:model="email">
                                <x-jet-input-error for="email" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control w-full"
                                    wire:model="direccion">
                                <x-jet-input-error for="direccion" />
                            </div>

                        </div>

                        <div class="py-4">
                            @include('livewire.proveedor.partials.tabla-servicios')
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

            <x-jet-button wire:click="save()" wire:loading.attr="disabled" class="disabled:opacity-25">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
