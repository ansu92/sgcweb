<div>

    <div class="flex flex-col lg:grid lg:grid-cols-5 gap-4">

        <x-card-condominio class="lg:col-span-2 lg:order-2" />

        <div class="lg:col-span-3 grid grid-cols-2 md:grid-cols-3 auto-rows-max gap-3 lg:order-1">
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
