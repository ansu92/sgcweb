@props(['comunicado'])

<div {{ $attributes->merge(['class' => 'flex flex-col shadow-md rounded bg-gray-50 w-full']) }}>
    <div class="px-2 py-1 bg-blue-500 rounded-t text-white font-bold">
        {{ $comunicado->asunto }}
    </div>
    <div class="px-4 py-1 space-y-2">
        <div>
            {{ $comunicado->contenido }}
        </div>
        <div>
            <span class="text-sm">Autor: </span>{{ $comunicado->autor->integrante->nombre }}
            {{ $comunicado->autor->integrante->apellido }}
        </div>
        <div>
            <span class="text-sm">Rol: </span>{{ $comunicado->autor->rol }}
        </div>
    </div>
</div>
