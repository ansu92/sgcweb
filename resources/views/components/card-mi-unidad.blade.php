<div {{ $attributes->merge(['class' => 'bg-white shadow-md border border-gray-200 rounded-lg']) }}>
    <img class="rounded-t-lg" src="{{ asset('img/casa.jpg') }}" alt="">

    <div class="p-5">
        <h5 class="text-gray-900 border-b-2 font-bold text-2xl tracking-tight mb-2 text-center">Mi unidad</h5>

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


