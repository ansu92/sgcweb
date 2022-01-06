<div>

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Nuevo rol
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="mt-10 sm:mt-0">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input wire:model.lazy="nombre" type="text" name="nombre" id="nombre"
                                    class="form-control w-full">
                                <x-jet-input-error for="nombre" />
                            </div>

                            <div class="col-span-6">
                                <h1 class="mb-2">Permisos</h1>

                                <div class="grid grid-cols-2 xl:grid-cols-3 gap-2">

                                    @foreach ($this->listaPermisos as $key => $item)
                                    <div class="flex items-start">
                                        <div class="flex items-center">
                                            <input wire:model.defer="permisos" type="checkbox"
                                            {{-- id="permiso_{{ $key }}"
                                                name="permiso_{{ $key }}" --}}
                                                value="{{ $item->id }}"
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="permiso_{{ $key }}"
                                                class="font-medium text-gray-700">{{ $item->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <x-jet-input-error for="permisos" />
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
