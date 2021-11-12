<div wire:init="$set('readyToLoad', true)">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-filtro>
                <x-slot name="contenido">

                    <div>
                        <label for="propietario" class="block text-sm font-medium text-gray-700 px-4">
                            Propietario
                        </label>
                        <label for="todos-propietario"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="propietario" type="radio" name="propietario" id="todos-propietario"
                                value="2">
                            Todas
                        </label>

                        <label for="con-propietario"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="propietario" type="radio" name="propietario" id="con-propietario"
                                value="1">
                            Con propietario
                        </label>

                        <label for="sin-propietario"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="propietario" type="radio" name="propietario" id="sin-propietario"
                                value="0">
                            Sin propietario
                        </label>
                    </div>

                    <div>
                        <label for="habitantes" class="block text-sm font-medium text-gray-700 px-4">
                            Habitantes
                        </label>
                        <label for="todos-habitantes"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="habitantes" type="radio" name="habitantes" id="todos-habitantes"
                                value="2">
                            Todas
                        </label>

                        <label for="con-habitantes"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="habitantes" type="radio" name="habitantes" id="con-habitantes" value="1">
                            Con habitantes
                        </label>

                        <label for="sin-habitantes"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="habitantes" type="radio" name="habitantes" id="sin-habitantes" value="0">
                            Sin habitantes
                        </label>
                    </div>

                    <div>
                        <label for="facturas" class="block text-sm font-medium text-gray-700 px-4">
                            Facturas
                        </label>
                        <label for="todos-facturas"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="facturas" type="radio" name="facturas" id="todos-facturas" value="2">
                            Todas
                        </label>

                        <label for="con-facturas"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="facturas" type="radio" name="facturas" id="con-facturas" value="1">
                            Con facturas
                        </label>

                        <label for="sin-facturas"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input wire:model="facturas" type="radio" name="facturas" id="sin-facturas" value="0">
                            Sin facturas
                        </label>
                    </div>

                </x-slot>
            </x-filtro>

            <x-jet-input wire:model="busqueda" type="text" placeholder="Escriba para buscar por número o dirección..."
                class="w-full" />

            <a href="{{ route('unidad.exportar', ['-' . $busqueda . '-' . 'numero' . '-' . 'asc' . '-' . $propietario . '-' . $habitantes . '-' . $facturas]) }}"
                class="btn btn-blue whitespace-nowrap">
                <i class="fas fa-file-export"></i> Exportar
            </a>

            @livewire('admin.unidad.nueva-unidad')
        </div>

        @if ($readyToLoad)

            @if (count($unidades))

                <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-3">
                    @foreach ($unidades as $item)
                        <a href="{{ route('admin.unidad.show', $item) }}">
                            <x-card-unidad :unidad="$item" />
                        </a>
                    @endforeach
                </div>

                @if ($unidades->hasPages())
                    <div class="px-6 py-3">
                        {{ $unidades->links() }}
                    </div>
                @endif

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

    </div>

</div>
