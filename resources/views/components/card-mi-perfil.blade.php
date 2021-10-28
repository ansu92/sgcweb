<div
    class = "rounded-xl  w-full bg-white shadow-lg transform duration-200 ease-in-out">

    <div class=" h-32 overflow-hidden rounded-t-lg">
        <img class="w-full"
            src="{{ asset('img/fondo.jpg') }}"
            alt="" />
    </div>

    <div class="flex justify-center px-5 -mt-12">
        <img class="sm:h-20 sm:w-20 md:h-28 md:w-28 lg:h-32 lg:w-32 bg-white p-2 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
            alt="{{ Auth::user()->name }}" />

    </div>

    <div class="pb-4">
        <div class="text-center px-14 sm:px-6">
            <h2 class="text-gray-800 text-2xl sm:text-lg md:text-2xl font-bold">{{ $persona->nombre }} {{ $persona->apellido }}</h2>

        </div>
        
    </div>

</div>
