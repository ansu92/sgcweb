<div>

    <div class="flex flex-col lg:grid lg:grid-cols-5 gap-4">

        <x-card-condominio class="lg:col-span-2 lg:order-2" />

        <div class="lg:col-span-3 grid grid-cols-2 md:grid-cols-3 auto-rows-max gap-3 lg:order-1">

            @if(!$this->mesEstaPendiente)
                <div class="col-span-3">
                    <div
                        class="group m-auto flex gap-6 md:gap-8 border border-yellow-500 transition-colors duration-1000 shadow-md py-4 px-10 md:px-4 rounded-md w-full h-30">
                        <div
                            class="h-15 p-4 shadow-md rounded-full border border-yellow-500 transition-colors duration-1000">
                            <span class="text-center text-3xl text-yellow-500"><i class="fas fa-exclamation-triangle"></i></span>
                        </div>
                        <div
                            class="text-lg border-b self-center border-yellow-500 transition-colors duration-1000 pb-1 text-gray-800 mt-1 font-semibold w-full">
                            <p class="font-bold">No ha cerrado el mes anterior</p>
                            <p class="text-sm">Debe cerrar el mes para generar las facturas del condominio.</p>
                        </div>
                    </div>
                </div>
            @endif

            @foreach ($menu as $item)

                @can($item['can'])

                    <a href="{{ route($item['ruta']) }}" class="w-auto h-auto">
                        <x-btn-admin nombre="{{ $item['nombre'] }}" imagen="{{ $item['imagen'] }}" />
                    </a>

                @endcan

            @endforeach
        </div>
    </div>
</div>
