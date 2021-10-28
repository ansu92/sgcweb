<div>

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Nuevo administrador
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                                <label for="documento"
                                    class="block text-sm font-medium text-gray-700">Documento:</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select id="letra" name="letra"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                            wire:model="letra">
                                            <option>V</option>
                                            <option>E</option>
                                        </select>
                                    </div>
                                    <input wire:model.lazy="documento" type="text" name="documento" id="documento"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Cédula">
                                </div>
                                <x-jet-input-error for="idResponsable" />
                                <x-jet-input-error for="documento" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                                <input wire:model.lazy="nombre" type="text" name="nombre" id="nombre"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="nombre" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="s_nombre" class="block text-sm font-medium text-gray-700">Segundo
                                    nombre:</label>
                                <input wire:model.lazy="segundoNombre" type="text" name="s_nombre" id="s_nombre"
                                    autocomplete="street-address"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="segundoNombre" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                                <input wire:model.lazy="apellido" type="text" name="apellido" id="apellido"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="apellido" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="s_apellido" class="block text-sm font-medium text-gray-700">Segundo
                                    apellido:</label>
                                <input wire:model.lazy="segundoApellido" type="text" name="s_apellido" id="s_apellido"
                                    autocomplete="street-address"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="segundoApellido" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de
                                    nacimiento:</label>
                                <input wire:model="fecha_nacimiento" type="date" name="fecha_nacimiento"
                                    id="fecha_nacimiento"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="fecha_nacimiento" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
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
                                    <input wire:model="telefono" type="text" name="telefono" id="telefono"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <x-jet-input-error for="telefono" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input wire:model.lazy="email" type="text" name="email" id="email" autocomplete="email"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="email" />
                            </div>

                            <div class="col-span-6">
                                <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                                <input wire:model.lazy="rol" type="text" name="rol" id="rol" autocomplete="rol"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="rol" />
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

            <x-jet-button wire:click="save()">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
