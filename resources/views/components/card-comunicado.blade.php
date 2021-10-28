@props(['comunicado'])

{{-- <div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50 w-full']) }}>
    <div class="px-2 py-1 bg-blue-500 rounded-t text-white font-bold">
        {{ $comunicado->asunto }}
    </div>
    <div class="px-4 py-1 space-y-2">
        <div>
            {{ $comunicado->contenido }}
        </div>
        <div>
            <strong class="text-sm text-gray-700">Autor: </strong>{{ $comunicado->autor->integrante->nombre }}
            {{ $comunicado->autor->integrante->apellido }}
        </div>
        <div>
            <strong class="text-sm text-gray-700">Rol: </strong>{{ $comunicado->autor->rol }}
        </div>
        <div>
            <strong class="text-sm text-gray-700">Fecha: </strong>{{ $comunicado->fecha}}
        </div>
    </div>
</div> --}}


<div {{ $attributes->merge(['class' => 'shadow-lg border rounded-xl p-4 bg-white relative overflow-hidden']) }}>

    <div class="flex items-center border-b-2 mb-2 py-2">
        <img class='w-10 h-10 object-cover rounded-full' alt='User avatar'
            src='{{ $comunicado->autor->user->profile_photo_url }}'>

        <div class="pl-3">
            <div class="font-medium">
                {{ $comunicado->autor->integrante->nombre }}
                {{ $comunicado->autor->integrante->apellido }}
            </div>
            <div class="text-gray-600 text-sm">
                {{ $comunicado->autor->rol }}
            </div>
        </div>
    </div>
    <div class="w-full">
        <p class="text-blue-600 text-xs font-medium mb-2">
            Fecha: {{ $comunicado->fecha }}
        </p>
        <p class="text-gray-600 text-sm mb-4">
            {{ $comunicado->contenido }}
        </p>
    </div>


</div>
