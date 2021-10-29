<div class="flex flex-col sm:grid sm:grid-cols-7 p-4">

    {{-- Comunicados --}}
    <div class="col-span-5 flex flex-col p-2 sm:p-4 gap-4">

        <div
            class="group col-span-5 px-2 py-1 text-gray-900 font-bold">
            <h1 class="text-3xl text-center">Últimos comunicados</h1>
            <hr class=" group-hover:bg-blue-500 transition-colors duration-1000 transform  h-1 bg-gray-100 rounded-xl ">
        </div>

        <div class="col-span-5 row-span-3 flex flex-col gap-4">
            @foreach ($comunicados as $item)
                <a href="{{ route('comunicado.show', $item) }}">
                    <x-card-comunicado :comunicado="$item" class="border" />
                </a>
            @endforeach
        </div>
    </div>

    {{-- Mi perfil y unidad --}}
    <div class="col-span-2 flex flex-col p-2 sm:p-4 gap-4">

        {{-- Mi perfil --}}
        <a href="{{ route('profile.show') }}">
            <x-card-mi-perfil />
        </a>

        @if (Auth::user()->propietario->integrante->unidad)
            {{-- Mi unidad --}}
            <a href="{{ route('unidad.show', Auth::user()->propietario->integrante->unidad) }}">
                <x-card-mi-unidad class="h-auto border" />
            </a>
        @endif

        {{-- Mis otras unidades --}}
        <a href="{{ route('unidad.index') }}">
            <div
                class="flex flex-col group shadow-md p-2 pl-5 pr-5 bg-transparent border hover:border-blue-500 text-gray-900 text-lg rounded-lg transition-colors duration-700 transform focus:border-4 focus:border-blue-300">
                <div class="px-4 py-2 border-b-2 group-hover:border-blue-500 transition-colors duration-700 transform rounded-t text-xl font-bold text-center">
                    Mis otras unidades
                </div>
            </div>
        </a>

    </div>
</div>
