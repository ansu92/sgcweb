<div wire:init="$set('readyToLoad', true)">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('gasto.nuevo-gasto')
        </div>

        {{-- tabla --}}
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        @if ($readyToLoad)

                            @if (count($gastos))

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Fecha
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Descripción
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Monto
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tipo
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Estado del pago
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Estado del cobro
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Acciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($gastos as $gasto)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $gasto->fecha }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $gasto->descripcion }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $gasto->monto }}

                                                    @switch($gasto->moneda)
                                                        @case('Bolívar')
                                                            Bs.
                                                        @break
                                                        @case('Dólar')
                                                            $
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($gasto->extraordinario)
                                                        Extraordinario
                                                    @else
                                                        Ordinario
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $gasto->estado_pago }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $gasto->estado_cobro }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium space-x-1">
                                                    <a href="{{ route('gasto.show', $gasto) }}"
                                                        class="btn btn-blue">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a wire:click="edit({{ $gasto }})" class="btn btn-green">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a wire:click="cancelar({{ $gasto }})"
                                                        class="btn btn-red">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if ($gastos->hasPages())
                                    <div class="px-6 py-3">
                                        {{ $gastos->links() }}
                                    </div>
                                @endif

                            @else
                                <div class="px-6 py-4">
                                    Su búsqueda no tuvo resultado
                                </div>
                            @endif

                        @else
                            <div class="px-6 py-4">
                                Cargando...
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        {{-- /table --}}

    </div>

    @if ($gasto->proveedor)
        <x-jet-dialog-modal wire:model="openEdit" maxWidth="4xl">
            <x-slot name="title">
                Editar el gasto
            </x-slot>

            <x-slot name="content">
                <div class="mt-10 sm:mt-0">

                    {{-- formulario --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                        Descripción:
                                    </label>
                                    <input type="text" name="descripcion" id="descripcion"
                                        value="{{ $gasto->descripcion }}" readonly class="form-control w-full">
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="monto" class="block text-sm font-medium text-gray-700">
                                        Monto total:
                                    </label>
                                    <input wire:model="gasto.monto" type="text" name="monto" id="monto" readonly
                                        class="form-control w-full">
                                    <x-jet-input-error for="gasto.monto" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="proveedor" class="block text-sm font-medium text-gray-700">
                                        Proveedor:
                                    </label>
                                    <input type="text" name="proveedor" id="proveedor"
                                        value="{{ $gasto->proveedor->nombre }}" readonly class="form-control w-full">
                                </div>

                            </div>

                            <div class="py-4">
                                @include('livewire.gasto.partials.tabla-servicios-edit')
                            </div>

                        </div>
                    </div>
                    {{-- /formulario --}}

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button class="mr-2" wire:click="$set('openEdit', false)">
                    Cancelar
                </x-jet-secondary-button>

                <x-jet-button wire:click="update">
                    Actualizar
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

    <x-jet-confirmation-modal wire:model="openCancelar">

        <x-slot name="title">
            Cancelar
        </x-slot>

        <x-slot name="content">
            ¿Seguro que desea detener el gasto común?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openCancelar', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="delete" wire:loading.attr="disabled" class="disabled:opacity-25">
                Detener
            </x-jet-danger-button>
        </x-slot>

    </x-jet-confirmation-modal>

</div>
