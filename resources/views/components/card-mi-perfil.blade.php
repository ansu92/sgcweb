<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50']) }}>

    <div class="px-4 py-2 bg-blue-500 rounded-t text-3xl text-white font-bold text-center">
        Mi perfil
    </div>

    {{-- Imagen --}}
    <div>
        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="max-h-80 h-full w-full object-scale-down" />
    </div>

    <div class="px-2 py-1">
        <span class="text-xs">Nombre: </span>{{ $persona->nombre }} {{ $persona->apellido }}
    </div>

</div>
