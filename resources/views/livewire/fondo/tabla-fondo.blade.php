<div wire:init="$set('readyToLoad', true)">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-filtro>
                <x-slot name="contenido">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 px-4">
                            Moneda
                        </label>

                        <label for="todos-moneda"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="moneda" type="radio" name="moneda" id="todos-moneda" value="2">
                            Todas
                        </label>

                        <label for="bolivar"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="moneda" type="radio" name="moneda" id="bolivar" value="1">
                            Bolívar
                        </label>

                        <label for="dolar"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="moneda" type="radio" name="moneda" id="dolar" value="0">
                            Dólar
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 px-4">
                            Saldo
                        </label>

                        <label for="minimo"
                            class="text-sm py-2 px-4 font-normal block w-full bg-transparent text-gray-700">
                            Mínimo:
                            <input wire:model="minimo" type="text" name="minimo" id="minimo"
                                class="form-control w-full">
                        </label>

                        <label for="maximo"
                            class="text-sm py-2 px-4 font-normal block w-full bg-transparent text-gray-700">
                            Máximo:
                            <input wire:model="maximo" type="text" name="maximo" id="maximo"
                                class="form-control w-full">
                        </label>
                    </div>

                </x-slot>
            </x-filtro>

            <x-jet-input type="text" placeholder="Escriba para buscar por nombre..." class="w-full"
                wire:model="busqueda" />

                <a href="{{ route('fondo.exportar', ['-' . $busqueda . '-' . $orden . '-' . $direccion . '-' . $moneda . '-' . $minimo . '-' . $maximo]) }}"
                class="btn btn-blue whitespace-nowrap">
                <i class="fas fa-file-export"></i> Exportar
            </a>

            @livewire('fondo.nuevo-fondo')
        </div>

        <!-- tabla -->
        @if ($readyToLoad)
            @if (count($fondos))
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach ($fondos as $item)
                        <a href="{{ route('fondo.show', $item) }}">
                            <x-card-fondo :fondo="$item" />
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
