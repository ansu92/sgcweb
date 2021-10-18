<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50']) }}>
    {{-- Título --}}
    <div class="px-4 py-2 bg-blue-500 rounded-t text-xl text-white font-bold text-center">
        Mi unidad
    </div>

    {{-- Imagen --}}
    <div class="p-4">
		<img src="{{asset('img/casa.png')}}" alt="casa" />
	</div>

    {{-- Contenido --}}
    <div class="px-2 py-1 text-sm space-y-2">
        <span class="text-xs">Número: </span>{{ $unidad->numero }}
        <div>
            <span class="text-xs">Dirección: </span>{{ $unidad->direccion }}
        </div>
        <div>
            {{ $unidad->integrantes_count }}


            @if ($unidad->integrantes_count != '1')
                <span class="text-xs"> habitantes</span>
            @else
                <span class="text-xs"> habitante</span>
            @endif
        </div>
    </div>
</div>
