<div class="bg-white overflow-hidden  shadow-xl rounded-xl">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Integrante
        </h3>
    </div>
    <div class="border-t border-gray-200">
        <dl>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Cédula:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $integrante->letra }}-{{ $integrante->documento }}
                </dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Nombre:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $integrante->nombre }} {{ $integrante->s_nombre }} {{ $integrante->apellido }}
                    {{ $integrante->s_apellido }}
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Fecha de nacimiento:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $integrante->fecha_nacimiento }}
                </dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Teléfono:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $integrante->telefono }}
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Email:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $integrante->email }}
                </dd>
            </div>

            @if ($integrante->unidad)
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Dirección:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $integrante->unidad->direccion }}
                    </dd>
                </div>
            @endif

        </dl>
    </div>
</div>
