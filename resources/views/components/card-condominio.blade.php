<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-white']) }}>

    <div class="p-5">
        <h5 class="text-gray-900 border-b-2 font-bold text-2xl tracking-tight mb-2 text-center">
            {{ $condominio->nombre }}
        </h5>

        <div class="flex flex-col gap-1">
            <div>Rif: {{ $condominio->rif }}</div>
            <div>Dirección:</div>
            <div> {{ $condominio->direccion }}</div>
            <div>Número de unidades: {{ $numUnidades }}</div>
        </div>

        <hr class="my-3">

        <div class="space-y-3">

            {{-- <div class="self-end"> --}}
                @livewire('admin.configurar-mensualidad')
            {{-- </div> --}}

            {{-- <div class="self-end"> --}}
                @livewire('admin.configurar-tasa-cambio')
            {{-- </div> --}}

            {{-- <div class="self-end"> --}}
                @livewire('admin.configurar-interes')
            {{-- </div> --}}

            {{-- <div class="self-end"> --}}
                @livewire('admin.configurar-iva')
            {{-- </div> --}}

        </div>
    </div>
</div>
