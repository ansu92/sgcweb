<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50']) }}>

    {{-- Header --}}
    <div class="px-4 py-2 bg-blue-500 rounded-t text-3xl text-white font-bold text-center">
        Nombre del condominio
    </div>

    {{-- Body --}}
    <div class="flex p-2 justify-between">

        {{-- Datos --}}
        <div class="flex flex-col gap-1">
            <div>Rif: {{ $condominio->rif }}</div>
            <div>Dirección:</div>
            <div> {{ $condominio->direccion }}</div>
            <div>Número de unidades: {{ $numUnidades }}</div>
        </div>

        {{-- Botones --}}
        <div class="self-end">
            <x-jet-button wire:click="$set('openMensualidad', true)">
                Actualizar mensualidad
            </x-jet-button>
        </div>
    </div>
</div>
