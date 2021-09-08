<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50']) }}>
    <div class="px-2 py-1 bg-blue-500 rounded-t text-white font-bold">
        {{ $unidad->numero }}
    </div>
    <div class="px-2 py-1 text-sm space-y-2">
        <div>
            {{ $unidad->direccion }}
        </div>
        <div>
            @if ($unidad->propietario)
                <span class="text-xs">Propietario: </span>{{ $propietario->nombre }} {{$propietario->apellido}}
			@else
				<span class="text-red-500">Sin propietario</span>
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
</div>
