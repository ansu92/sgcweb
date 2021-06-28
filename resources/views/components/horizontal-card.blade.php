@props(['descripcion', 'moneda', 'saldo'])

<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50 w-full']) }}>
    <div class="px-2 py-1 bg-blue-500 rounded-t text-white font-bold">
        {{ $descripcion }}
    </div>
    <div class="px-4 py-1 space-y-2">
        <div>
            <span class="text-sm">Moneda: </span>{{ $moneda }}
        </div>
        <div>
			<span class="text-sm">Saldo: </span>{{ $saldo }}
        </div>
    </div>
</div>
