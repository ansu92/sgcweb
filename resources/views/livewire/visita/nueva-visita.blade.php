<div>

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Nueva visita
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="mt-10 sm:mt-0">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                                <label for="numero_ci" class="block text-sm font-medium text-gray-700">Cédula</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select wire:model="letra" id="letra" name="letra"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                            <option>V</option>
                                            <option>E</option>
                                        </select>
                                    </div>
                                    <input wire:model.lazy="ci" type="text" name="numero_ci" id="numero_ci"
                                        class="form-control block w-full pl-12">
                                </div>
                                <x-jet-input-error for="letra" />
                                <x-jet-input-error for="ci" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input wire:model="nombre" type="text" name="nombre" id="nombre"
                                    class="form-control w-full">
                                <x-jet-input-error for="nombre" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                                <input wire:model="apellido" type="text" name="apellido" id="apellido"
                                    class="form-control w-full">
                                <x-jet-input-error for="apellido" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="unidad" class="block text-sm font-medium text-gray-700">Unidad</label>
                                <select id="unidad" name="unidad" class="form-control w-full" wire:model="unidad.id">
                                    <option value="0"> ---- </option>
                                    @foreach ($unidades as $item)
                                        <option value="{{ $item->id }}">{{ $item->numero }} - {{ $item->propietario->integrante->nombre }}
                                            {{ $item->propietario->integrante->apellido }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="unidad.id" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="num_personas" class="block text-sm font-medium text-gray-700">Número de
                                    personas</label>
                                <input wire:model="numeroPersonas" type="number" name="num_personas" id="num_personas"
                                    class="form-control w-full">
                                <x-jet-input-error for="numeroPersonas" />
                            </div>

                            <div class="col-span-6 sm:col-span-2 sm:col-start-1">
                                <label for="matricula" class="block text-sm font-medium text-gray-700">Matrícula</label>
                                <input wire:model="matricula" type="text" name="matricula" id="matricula"
                                    class="form-control w-full">
                                <x-jet-input-error for="matricula" />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
                                <input wire:model="marca" type="text" name="marca" id="marca"
                                    class="form-control w-full">
                                <x-jet-input-error for="marca" />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                <input wire:model="modelo" type="text" name="modelo" id="modelo"
                                    class="form-control w-full">
                                <x-jet-input-error for="modelo" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                                <input wire:model="color" type="text" name="color" id="color"
                                    class="form-control w-full">
                                <x-jet-input-error for="color" />
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

            <x-jet-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
