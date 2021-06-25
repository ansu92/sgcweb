<div wire:init="loadUnidades">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <div class="flex items-center">
                <span>Mostrar</span>

                <select wire:model="cantidad" class="mx-2 form-control">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <span>entradas</span>
            </div>

            <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('nueva-unidad')
        </div>

        @if ($readyToLoad)

            @if (count($unidades))

                <div class="grid sm:grid-cols-3 xl:grid-cols-5 gap-3">
                    @foreach ($unidades as $item)
                        <a href="{{ route('unidad.show', $item->id) }}">
                            <x-card-unidad class="h-36">

                                <x-slot name="numero">
                                    {{ $item->numero }}
                                </x-slot>

                                <x-slot name="direccion">
                                    {{ $item->direccion }}
                                </x-slot>

                                <x-slot name="propietario">
                                    @if ($item->integrantes->count())
                                        {{ $item->propietario->integrante->nombre . ' ' . $item->propietario->integrante->apellido }}
                                    @else
                                        0
                                    @endif
                                </x-slot>

                                <x-slot name="numHabitantes">
                                    @if ($item->integrantes->count())
                                        {{ $item->integrantes->count() }}
                                    @else
                                        0
                                    @endif
                                </x-slot>

                            </x-card-unidad>
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
