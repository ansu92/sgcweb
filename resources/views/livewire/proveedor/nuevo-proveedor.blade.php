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
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select wire:model="letra" id="letra" name="letra"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                            <option>V</option>
                                            <option>E</option>
                                            <option>J</option>
                                        </select>
                                    </div>
                                    <input wire:model.lazy="documento" type="text" name="numero_documento"
                                        id="numero_documento" class="form-control block w-full pl-12"
                                        placeholder="Cédula o RIF">
                                </div>
                                <x-jet-input-error for="letra" />
                                <x-jet-input-error for="documento" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del proveedor</label>
                                <input wire:model.lazy="nombre" type="text" name="nombre" id="nombre"
                                    class="form-control w-full">
                                <x-jet-input-error for="nombre" />
                            </div>

                            <div class="col-span-3">
                                <label for="contacto" class="block text-sm font-medium text-gray-700">Nombre del
                                    contacto</label>
                                <input wire:model.lazy="contacto" type="text" name="contacto" id="contacto"
                                    class="form-control w-full">
                                <x-jet-input-error for="contacto" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select wire:model="codigo" id="codigo" name="codigo"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                            <option>0412</option>
                                            <option>0414</option>
                                            <option>0416</option>
                                            <option>0424</option>
                                            <option>0426</option>
                                        </select>
                                    </div>
                                    <input wire:model.lazy="telefono" type="text" name="telefono" id="telefono"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <x-jet-input-error for="telefono" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input wire:model="email" type="email" name="email" id="email" autocomplete="email"
                                    class="form-control w-full">
                                <x-jet-input-error for="email" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <input wire:model="direccion" type="text" name="direccion" id="direccion"
                                    class="form-control w-full">
                                <x-jet-input-error for="direccion" />
                            </div>

                        </div>

                        <div class="py-4">
							<h2 class="text-center text-xl font-semibold">Seleccione los servicios que ofrece el proveedor</h2>
							<x-jet-input-error for="servicios" />
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

            <x-jet-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
