<div>

    <div class="flex flex-col lg:grid lg:grid-cols-5 gap-4 h-auto">

        <x-card-condominio class="lg:col-span-2 lg:order-2" />

        <div class="grid grid-cols-2 md:grid-cols-3 lg:col-span-3 gap-3 lg:order-1">
            @foreach ($menu as $item)

                @can($item['can'])

                    <a href="{{ route($item['ruta']) }}">
                        <x-btn-admin :nombre="$item['nombre']" :imagen="$item['imagen']" />
                    </a>

                @endcan

            @endforeach
        </div>
    </div>

</div>
