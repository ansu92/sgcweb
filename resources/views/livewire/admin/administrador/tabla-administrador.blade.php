<div wire:init="$set('readyToLoad', true)">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('admin.administrador.nuevo-administrador')
        </div>

        <!-- tabla -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cédula
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Apellido
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rol
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($administradores as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->integrante->letra }}-{{ $item->integrante->documento }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->integrante->nombre }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->integrante->apellido }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->rol }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap space-x-1 text-xs">
                                            <a href="{{ route('admin.administrador.show', $item) }}" class="btn btn-blue">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-green" wire:click="edit({{ $item }})">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-red" wire:click="destroy({{ $item }})">
                                                <i class="fas fa-trash"></i>
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
        {{-- /tabla --}}

    </div>

    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            Editar responsable
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
{{-- 
                            <div class="col-span-6 sm:col-span-3">
                                <label for="documento"
                                    class="block text-sm font-medium text-gray-700">Documento:</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select wire:model="administrador.integrante.letra" id="letra" name="letra" disabled
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                            <option>V</option>
                                            <option>E</option>
                                        </select>
                                    </div>
                                    <input wire:model.lazy="administrador.integrante.documento" type="text" name="documento" id="documento" readonly
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Cédula">
                                </div>
                                <x-jet-input-error for="administrador.integrante.documento" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                                <input wire:model.lazy="administrador.integrante.nombre" type="text" name="nombre" id="nombre" readonly
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="administrador.integrante.nombre" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="s_nombre" class="block text-sm font-medium text-gray-700">Segundo
                                    nombre:</label>
                                <input wire:model.lazy="administrador.integrante.s_nombre" type="text" name="s_nombre" id="s_nombre" readonly
                                    autocomplete="street-address"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="administrador.integrante.s_nNombre" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                                <input wire:model.lazy="administrador.integrante.apellido" type="text" name="apellido" id="apellido" readonly
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="administrador.integrante.apellido" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="s_apellido" class="block text-sm font-medium text-gray-700">Segundo
                                    apellido:</label>
                                <input wire:model.lazy="administrador.integrante.s_apellido" type="text" name="s_apellido" id="s_apellido" readonly
                                    autocomplete="street-address"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="administrador.integrante.s_apellido" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                <input wire:model.lazy="administrador.integrante.telefono" type="tel" name="telefono" id="telefono" readonly
                                    pattern="\d{4}-\d{7}" class="form-control w-full">
                                <small class="text-xs text-gray-600">Formato: 0412-1234567</small>
                                <x-jet-input-error for="administrador.integrante.telefono" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input wire:model.lazy="administrador.integrante.email" type="text" name="email" id="email" autocomplete="email" readonly
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="administrador.integrante.email" />
                            </div> --}}

                            <div class="col-span-6">
                                <label for="rol" class="block text-sm font-medium text-gray-700">Rol</label>
                                <input wire:model.lazy="administrador.rol" type="text" name="rol" id="rol" autocomplete="rol"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-jet-input-error for="administrador.rol" />
                            </div>

                        </div>
                    </div>
                </div>
                {{-- /formulario --}}

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('openEdit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="openDestroy">

        <x-slot name="title">
            Eliminar
        </x-slot>

        <x-slot name="content">
            ¿Seguro que desea eliminar al administrador?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openDestroy', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="delete" wire:loading.attr="disabled" class="disabled:opacity-25">
                Eliminar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-confirmation-modal>

</div>
