{{-- <div {{ $attributes->merge(['class' => 'relative flex flex-col shadow-md rounded bg-gray-50']) }}>

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
            
        </span>
    @endif
</div> --}}
<div
    {{ $attributes->merge(['class' => 'relative overflow-hidden shadow-lg ease-in-out transform rounded-lg h-full cursor-pointer m-auto']) }}>
    <img alt="blog photo" src="{{ asset('img/casa.jpg') }}" class="max-h-40 w-full object-cover" />
    <div class="bg-white w-full p-4">
        <p class="text-gray-800 text-2xl font-black">
            Unidad : {{ $unidad->numero }}
        </p>
        <div class="flex items-center py-2">
            @if ($unidad->propietario)
                <img class='w-10 h-10 object-cover rounded-full' alt='User avatar'
                    src="{{ $unidad->propietario->user->profile_photo_url }}">
                <div class="pl-3 font-medium">
                    {{ $propietario->nombre }} {{ $propietario->apellido }}
                </div>
            @else
                <div class="pl-3 font-medium">
                    <strong class="text-red-500">Sin propietario</strong>
                </div>
            @endif
        </div>
        <p class="text-gray-800 text-sm font-medium mb-2">
            Dirección: {{ $unidad->direccion }}
        </p>
        <div>
            <p class="text-gray-800 text-sm font-medium mb-2">
                @if ($numHabitantes)
                    {{ $numHabitantes }}

                    @if ($numHabitantes == 1)
                        <span class="text-xs"> habitante</span>
                    @else
                        <span class="text-xs"> habitantes</span>
                    @endif
                @endif
            </p>
        </div>
    </div>
    @if ($tieneFacturas)
        <div class="w-10 h-10 object-cover absolute bottom-2 right-2 ">
            <img src="/img/iconos/factura.png" alt="">
        </div>
    @endif
</div>
