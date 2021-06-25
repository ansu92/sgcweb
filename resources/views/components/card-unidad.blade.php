<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50']) }}>
    <div class="px-2 py-1 bg-blue-500 rounded-t text-white font-bold">
        {{ $numero }}
    </div>
    <div class="px-2 py-1 text-sm space-y-2">
        <div>
            {{ $direccion }}
        </div>
        <div>
            @if ($numHabitantes != '0')
            	<span class="text-xs">Propietario: </span>{{ $propietario }}
            @endif
        </div>
        <div>
            @if ($numHabitantes != '0')
                {{ $numHabitantes }}


                @if ($numHabitantes > '1')
                    <span class="text-xs"> habitantes</span>
                @else
                    <span class="text-xs"> habitante</span>
                @endif
            @endif
        </div>
    </div>
</div>
