<div
    class="group m-auto cursor-pointer flex gap-6 md:gap-8 border border-gray-200 hover:border-blue-500 transition-colors duration-1000 shadow-md py-4 px-10 md:px-4 rounded-md">
    <div
        class="shadow-md rounded-full border border-gray-200 group-hover:border-blue-500 transition-colors duration-1000 h-auto w-20 p-4">
        <img class="h-auto w-20" src="{{ asset($icono) }}" alt="" />
    </div>
    <div
        class="text-lg border-b self-center border-gray-200 group-hover:border-blue-500 transition-colors duration-1000 pb-1 text-gray-800 mt-1 font-semibold whitespace-nowrap w-full">
        {{ $nombre }}
    </div>
</div>
