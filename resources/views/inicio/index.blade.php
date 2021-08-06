<div class="grid grid-cols-5 p-4">

    <div class="col-span-3 grid grid-cols-5 p-4 gap-4">
        @for ($i = 0; $i < 5; $i++)
            <div class="h-full">
                <a href="{{route('pago.index')}}">
                    <x-card-acceso-directo nombre="Pagar" class="border h-full" />
                </a>
            </div>
        @endfor

        <div class="col-span-5 row-span-3 flex flex-col gap-4">
            @foreach ($comunicados as $item)
                <x-card-comunicado :comunicado="$item" class="border" />
            @endforeach
        </div>
    </div>

    <div class="col-span-2 grid p-4 gap-4">
        <div class="h-full">
            <a href="{{ route('profile.show') }}">
                <x-card-mi-perfil class="h-full border" />
            </a>
        </div>
        <div class="h-full">
            <a href="{{ route('unidad.show', Auth::user()->propietario->unidades->first()) }}">
                <x-card-mi-unidad class="h-full border" />
            </a>
        </div>
    </div>
</div>
