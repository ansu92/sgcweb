<div wire:init="loadUnidades">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('admin.unidad.nueva-unidad')
        </div>

        @if ($readyToLoad)

            @if (count($unidades))

                <div class="grid sm:grid-cols-3 xl:grid-cols-5 gap-3">
                    @foreach ($unidades as $item)
                        <a href="{{ route('admin.unidad.show', $item) }}">
                            <x-card-unidad class="h-40">

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
