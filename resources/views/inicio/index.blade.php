<div class="grid grid-cols-5 p-4">

    <div class="col-span-3 grid grid-cols-5 p-4 gap-4">
        {{-- @for ($i = 0; $i < 5; $i++) --}}
        <div class="h-full">
            <a href="{{ route('pago.index') }}">
                <x-card-acceso-directo nombre="Acceso Directo 1" class="border h-full" />
            </a>
        </div>
        <div class="h-full">
            <a href="{{ route('pago.index') }}">
                <x-card-acceso-directo nombre="Acceso Directo 2" class="border h-full" />
            </a>
        </div>
        <div class="h-full">
            <a href="{{ route('pago.index') }}">
                <x-card-acceso-directo nombre="Acceso Directo 3" class="border h-full" />
            </a>
        </div>
        <div class="h-full">
            <a href="{{ route('pago.index') }}">
                <x-card-acceso-directo nombre="Acceso Directo 4" class="border h-full" />
            </a>
        </div>
        <div class="h-full">
            <a href="{{ route('pago.index') }}">
                <x-card-acceso-directo nombre="Acceso Directo 5" class="border h-full" />
            </a>
        </div>
        {{-- @endfor --}}

        <div class="col-span-5 row-span-3 flex flex-col gap-4">
            @foreach ($comunicados as $item)
                <a href="{{ route('comunicado.show', $item) }}">
                    <x-card-comunicado :comunicado="$item" class="border" />
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-span-2 grid p-4 gap-4">
        <div class="h-full">
            <a href="{{ route('profile.show') }}">
                <x-card-mi-perfil class="h-full border" />
            </a>
        </div>
        @if (Auth::user()->propietario->integrante->unidad)
            <div class="h-full">
                <a href="{{ route('unidad.show', Auth::user()->propietario->integrante->unidad) }}">
                    <x-card-mi-unidad class="h-full border" />
                </a>
            </div>
        @endif
        <a href="{{ route('unidad.index') }}">
            <div class="flex flex-col shadow-md rounded bg-gray-50'">
                <div class="px-4 py-2 bg-blue-500 rounded-t text-3xl text-white font-bold text-center">
                    Mis otras unidades
                </div>
            </div>
        </a>
    </div>
</div>
