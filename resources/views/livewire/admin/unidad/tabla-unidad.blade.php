<div wire:init="loadUnidades">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input wire:model="busqueda" type="text" placeholder="Escriba para buscar..." class="w-full" />

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
