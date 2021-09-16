<div {{ $attributes->merge(['class' => 'relative flex flex-col shadow-md rounded bg-gray-50']) }}>

    <div class="px-2 py-1 bg-{{ $color }}-500 rounded-t text-white font-bold">
        {{ $unidad->numero }}
    </div>

    <div class="px-2 py-1 text-sm space-y-2">

        <div>
            {{ $unidad->direccion }}
        </div>

        <div>
            @if ($unidad->propietario)
                <span class="text-xs">Propietario: </span>{{ $propietario->nombre }}
                {{ $propietario->apellido }}
            @else
                <strong class="text-red-500">Sin propietario</strong>
            @endif
        </div>

        <div>
            @if ($numHabitantes)
                {{ $numHabitantes }}

                <span class="text-xs">
                    @if ($numHabitantes == 1)
                        habitante
                    @else
                        habitantes
                    @endif
                </span>
            @endif
        </div>

    </div>

    @if ($tieneFacturas)
        <span class="block absolute bottom-2 right-2 text-2xl text-red-500">
            <i class="fas fa-money-check-alt"></i>
            {{-- <i class="fas fa-exclamation"></i> --}}
        </span>
    @endif
</div>
