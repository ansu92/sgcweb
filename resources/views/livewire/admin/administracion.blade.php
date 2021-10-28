<div>

    <div class="grid grid-cols-5 gap-4">

        <div class="col-span-3 flex flex-col gap-3">

            <a href="{{ route('admin.unidad.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Lista de unidades
                </div>
            </a>

            <a href="{{ route('pago.create') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Pagar gastos
                </div>
            </a>

            <a href="{{ route('comunicado.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Comunicados
                </div>
            </a>

            <a href="{{ route('gasto.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Registrar gastos
                </div>
            </a>

            <a href="{{ route('admin.sancion.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Gestionar sanciones
                </div>
            </a>

            <a href="{{ route('aplicar-sancion.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Aplicar sanción
                </div>
            </a>

            <div wire:click="$set('openInteres', true)"
                class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center cursor-pointer">
                Configurar interés
            </div>

            <a href="{{ route('categoria.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Gestionar categorías
                </div>
            </a>

            <a href="{{ route('enfermedad.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Gestionar enfermedades
                </div>
            </a>

            <a href="{{ route('medicamento.index') }}">
                <div class="px-4 py-2 bg-blue-500 rounded text-lg text-white font-bold text-center">
                    Gestionar medicamentos
                </div>
            </a>

        </div>

        <x-card-condominio class="col-span-2" />
    </div>

    <x-jet-dialog-modal wire:model="openMensualidad">
        <x-slot name="title">
            Actualizar mensualidad
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label for="monto" class="block text-sm font-medium text-gray-700">
                                Monto:
                            </label>
                            <input wire:model="monto" type="text" name="monto" id="monto" class="form-control w-full">
                            <x-jet-input-error for="monto" />
                        </div>

                        <div class="col-span-6">
                            <label for="moneda" class="block text-sm font-medium text-gray-700">
                                Moneda:
                            </label>
                            <select wire:model="moneda" name="moneda" id="moneda" class="form-control w-full">
                                <option>Bolívar</option>
                                <option>Dólar</option>
                            </select>
                            <x-jet-input-error for="moneda" />
                        </div>

                        <div class="col-span-6">
                            <x-jet-input-error for="asistentes" />

                            <div class="space-y-4">
                                <div class="flex space-x-4 items-center">

                                    <x-select-cantidad />

                                    <x-jet-input type="text" placeholder="Escriba para buscar por fecha..."
                                        class="w-full" wire:model="busqueda" />

                                </div>

                                <!-- tabla -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                @if (count($mensualidades))
                                                    <table class="min-w-full divide-y divide-gray-200">

                                                        <thead class="bg-gray-50">
                                                            <tr>

                                                                <th scope="col"
                                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Fecha
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Monto
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Moneda
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">

                                                            @foreach ($mensualidades as $item)
                                                                <tr>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->fecha }}
                                                                        </div>
                                                                    </td>

                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->monto }}
                                                                        </div>
                                                                    </td>

                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->moneda }}
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($mensualidades->hasPages())
                                                        <div class="px-6 py-3">
                                                            {{ $mensualidades->links() }}
                                                        </div>
                                                    @endif

                                                @else
                                                    <div class="px-6 py-4">
                                                        Su búsqueda no tuvo resultado
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>


            </div>
            {{-- /formulario --}}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('openMensualidad', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="actualizar" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="openInteres">
        <x-slot name="title">
            Actualizar interés
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label for="factor" class="block text-sm font-medium text-gray-700">
                                Factor:
                            </label>
                            <input wire:model="factor" type="text" name="factor" id="factor"
                                class="form-control w-full">
                            <x-jet-input-error for="factor" />
                        </div>

                        <div class="col-span-6">
                            <label for="activar-intereses" class="block text-sm font-medium text-gray-700">
                                Activar intereses?
                            </label>
                            <div>
                                <input wire:model="estado" type="radio" name="activar-intereses" id="si"
                                    value="1">
                                <label for="si">Sí</label>
                                <input wire:model="estado" type="radio" name="activar-intereses" id="no"
                                    value="0" class="ml-2">
                                <label for="no">No</label>
                            </div>
                            <x-jet-input-error for="estado" />
                        </div>

                        <div class="col-span-6">
                            <x-jet-input-error for="asistentes" />

                            <div class="space-y-4">
                                <div class="flex space-x-4 items-center">

                                    <x-select-cantidad />

                                    <x-jet-input type="text" placeholder="Escriba para buscar por fecha..."
                                        class="w-full" wire:model="busqueda" />

                                </div>

                                <!-- tabla -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                @if (count($intereses))
                                                    <table class="min-w-full divide-y divide-gray-200">

                                                        <thead class="bg-gray-50">
                                                            <tr>

                                                                <th scope="col"
                                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Fecha
                                                                </th>

                                                                <th scope="col"
                                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Factor
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">

                                                            @foreach ($intereses as $item)
                                                                <tr>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->fecha }}
                                                                        </div>
                                                                    </td>

                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="text-sm font-medium text-gray-900">
                                                                            {{ $item->factor }}%
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @if ($intereses->hasPages())
                                                        <div class="px-6 py-3">
                                                            {{ $intereses->links() }}
                                                        </div>
                                                    @endif

                                                @else
                                                    <div class="px-6 py-4">
                                                        Su búsqueda no tuvo resultado
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>


            </div>
            {{-- /formulario --}}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('openInteres', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="actualizarInteres" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
