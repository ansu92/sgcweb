<div>

    <x-jet-button wire:click="$set('abierto', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="abierto">
        <x-slot name="title">
            Nueva cuenta
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">

                                <label for="documento" class="block text-sm font-medium text-gray-700">Documento:</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select id="letra" name="letra"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                            wire:model="letra">
                                            <option value="V">V</option>
                                            <option value="E">E</option>
                                            <option value="J">J</option>
                                        </select>
                                    </div>
                                    <input type="text" name="documento" id="documento"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Cédula o RIF" wire:model="documento">
                                </div>
                                <x-jet-input-error for="documento" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="beneficiario"
                                    class="block text-sm font-medium text-gray-700">Beneficiario:</label>
                                <input type="text" name="beneficiario" id="beneficiario"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="beneficiario">
                                <x-jet-input-error for="beneficiario" />
                            </div>

                            <div class="col-span-6">
                                <label for="numero" class="block text-sm font-medium text-gray-700">Número de
                                    cuenta:</label>
                                <input type="text" name="numero" id="numero" autocomplete="street-address"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="numero">
                                <x-jet-input-error for="numero" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="banco_id" class="block text-sm font-medium text-gray-700">Banco:</label>
                                <select id="banco_id" name="banco_id" class="form-control w-full" wire:model="banco_id">
                                    <option value="0"> -- </option>
                                    @foreach ($bancos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="banco_id" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de
                                    cuenta:</label>
                                <select id="tipo" name="tipo" class="form-control w-full" wire:model="tipo">
                                    <option value="0"> -- </option>
                                    <option>Ahorro</option>
                                    <option>Corriente</option>
                                </select>
                                <x-jet-input-error for="tipo" />
                            </div>


                        </div>
                    </div>
                </div>
                {{-- /formulario --}}

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('abierto', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="save()">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
