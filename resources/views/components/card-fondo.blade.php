<div
    class="shadow-lg group border hover:border-blue-500 transition-colors duration-1000 transform rounded-xl p-4 bg-white relative overflow-hidden">

    <div
        class="flex items-center border-b-2 group-hover:border-blue-500 transition-colors duration-1000 transform mb-2 pb-2">
        @if ($fondo->moneda == 'Dólar')
            <img class='w-12 h-12 object-cover rounded-full' alt='User avatar'
                src='{{ asset('img/monedas/dolar.png') }}'>
        @else
            <img class='w-12 h-12 object-cover rounded-full' alt='User avatar'
                src='{{ asset('img/monedas/bolivar.png') }}'>
        @endif

        <div class="pl-3">
            <div class="text-lg text-gray-700">
                {{$fondo->descripcion}}
            </div>
        </div>
    </div>
    <div class="w-full">
        <p class="text-gray-700 text-sm mb-2">
            Saldo:
        </p>
        <p class="text-gray-700 font-black text-xl text-center mb-2">
            {{$fondo->saldo}} @if ($fondo->moneda == 'Dólar') $ @else Bs @endif
        </p>
    </div>
</div>
