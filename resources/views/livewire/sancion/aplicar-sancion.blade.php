<div wire:init="$set('readyToLoad', true)">

    <div class="py-6 space-y-2">
        <h1 class="text-center text-xl font-semibold">Seleccione la unidad a aplicar la sanción...</h1>

        @include('livewire.sancion.partials.tabla-unidades')
    </div>

    <x-jet-dialog-modal wire:model="open" maxWidth='2xl'>
        <x-slot name="title">
            Aplicar sanción
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                <!-- tabla -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                @if ($readyToLoad)
                                    @if (count($listaSanciones))
                                        <table class="min-w-full divide-y divide-gray-200">

                                            <thead class="bg-gray-50">
                                                <tr>

                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                        Descripción
                                                    </th>

                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                        Monto

                                                    </th>


                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                        Moneda

                                                    </th>

                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1">

                                                        <input wire:model="selectPage" type="checkbox" name="selectPage"
                                                            id="selectPage" class="form-control">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @if ($selectPage)
                                                    <tr>
                                                        <td colspan="5"
                                                            class=" text-sm px-6 py-4 whitespace-nowrap bg-gray-200">

                                                            @unless($selectAll)
                                                                <div>
                                                                    <span>Ha seleccionado
                                                                        <strong>{{ count($sanciones) }}</strong>
                                                                        personas. ¿Quiere seleccionar
                                                                        todas las
                                                                        <strong>{{ $listaSanciones->total() }}</strong>
                                                                        sanciones?</span>


                                                                    <button class="text-blue-500"
                                                                        wire:click="$set('selectAll', true)">
                                                                        Seleccionar todo
                                                                    </button>
                                                                </div>
                                                            @else

                                                                <span>Ha seleccionado
                                                                    <strong>{{ $listaSanciones->total() }}</strong>
                                                                    sanciones</span>

                                                            @endunless

                                                        </td>
                                                    </tr>
                                                @endif
                                                @foreach ($listaSanciones as $item)
                                                    <tr>

                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->descripcion }}
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

                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-xs space-x-1 font-medium">
                                                            <input type="checkbox" value="{{ $item->id }}"
                                                                class="form-control" wire:model="sanciones">

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if ($listaSanciones->hasPages())
                                            <div class="px-6 py-3">
                                                {{ $listaSanciones->links() }}
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
                <!-- /tabla -->

                <x-jet-input-error for="sanciones" />

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="save" wire:loading.attr="disabled">
                Aplicar sanción
            </x-jet-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
