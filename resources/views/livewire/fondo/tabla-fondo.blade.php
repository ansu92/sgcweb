<div wire:init="loadFondos">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('fondo.nuevo-fondo')
        </div>

        <!-- tabla -->
        @if ($readyToLoad)
            @if (count($fondos))
                <div class="flex flex-col gap-4">
                    @foreach ($fondos as $item)
                        <a href="{{ route('fondo.show', $item) }}">
							<x-horizontal-card :descripcion="$item->descripcion" :moneda="$item->moneda" :saldo="$item->saldo" />
						</a>
                    @endforeach

                    @if ($fondos->hasPages())
                        <div class="px-6 py-3">
                            {{ $fondos->links() }}
                        </div>
                    @endif

                </div>
            @else
                <div class="px-6 py-4">
                    Su búsqueda no tuvo resultado
                </div>
            @endif

        @else
            <div class="px-6 py-4">
                Cargando...
            </div>
        @endif
        {{-- /tabla --}}
    </div>

    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            Editar la categoría
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6">
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="nombre"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="categoria.nombre">
                                <x-jet-input-error for="categoria.nombre" />
                            </div>

                            <div class="col-span-6">
                                <label for="descripcion"
                                    class="block text-sm font-medium text-gray-700">Descripción</label>
                                <input type="text" name="descripcion"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="categoria.descripcion">
                                <x-jet-input-error for="categoria.descripcion" />
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
            ¿Seguro que desea eliminar la categoría?
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
