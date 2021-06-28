<div>

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Nueva unidad
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">
                                <label for="numero" class="block text-sm font-medium text-gray-700">Número:</label>
                                <input type="text" name="numero" id="numero"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="numero">
                                <x-jet-input-error for="numero" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="tipoUnidad" class="block text-sm font-medium text-gray-700">Tipo de unidad:</label>
                                <select name="tipoUnidad" id="tipoUnidad" class="form-control w-full" wire:model="tipoUnidad">
									<option value="null"> -- </option>
									@foreach ($tipoUnidades as $item)
										<option value="{{ $item->id }}">{{ $item->nombre }}</option>
									@endforeach
								</select>
                                <x-jet-input-error for="tipoUnidad" />
                            </div>

                            <div class="col-span-6">
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                                <input type="text" name="direccion" id="direccion"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="direccion">
                                <x-jet-input-error for="direccion" />
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
