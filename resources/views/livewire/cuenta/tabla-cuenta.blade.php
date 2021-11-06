<div wire:init="loadCuentas">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">

            <x-select-cantidad />

            <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

            @livewire('cuenta.nueva-cuenta')

            <a href="{{ route('cuenta.exportar') }}">
                <button class="btn btn-blue">
                    Exportar todos
                </button>
            </a>
        </div>

        <!-- tabla -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        @if ($readyToLoad)
                            @if (count($cuentas))
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                wire:click="orden('numero')">
                                                Número

                                                @if ($orden == 'numero')

                                                    @if ($direccion == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                    @endif

                                                @else
                                                    <i class="fas fa-sort float-right mt-1"></i>

                                                @endif
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                wire:click="orden('tipo')">
                                                Tipo

                                                @if ($orden == 'tipo')

                                                    @if ($direccion == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                    @endif

                                                @else
                                                    <i class="fas fa-sort float-right mt-1"></i>

                                                @endif

                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                wire:click="orden('documento')">
                                                Documento

                                                @if ($orden == 'documento')

                                                    @if ($direccion == 'asc')
                                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                    @else
                                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                    @endif

                                                @else
                                                    <i class="fas fa-sort float-right mt-1"></i>

                                                @endif

                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Beneficiario
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Banco
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Acciones</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($cuentas as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->numero }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->tipo }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->documento }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->beneficiario }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->banco->nombre }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-xs space-x-1 font-medium">
                                                    <a class="btn btn-blue"
                                                        href="{{ route('cuenta.show', $item) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-green" wire:click="edit({{ $item }})">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-red" wire:click="destroy({{ $item }})">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($cuentas->hasPages())
                                    <div class="px-6 py-3">
                                        {{ $cuentas->links() }}
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
        {{-- /tabla --}}
    </div>

    <x-jet-dialog-modal wire:model="openEdit">
        <x-slot name="title">
            Modificar cuenta
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-3">

                                <label for="documento"
                                    class="block text-sm font-medium text-gray-700">Documento:</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select id="letra" name="letra"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                            wire:model="letra">
                                            <option value="V">V</option>
                                            <option value="E">E</option>
                                            <option value="J">J</option>
                                        </select>
                                    </div>
                                    <input type="text" name="documento" id="documento"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Cédula o RIF" wire:model="documento">
                                </div>
                                <x-jet-input-error for="letra" />
                                <x-jet-input-error for="documento" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="beneficiario"
                                    class="block text-sm font-medium text-gray-700">Beneficiario:</label>
                                <input type="text" name="beneficiario" id="beneficiario"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="cuenta.beneficiario">
                                <x-jet-input-error for="cuenta.beneficiario" />
                            </div>

                            <div class="col-span-6">
                                <label for="numero" class="block text-sm font-medium text-gray-700">Número de
                                    cuenta:</label>
                                <input type="text" name="numero" id="numero" autocomplete="street-address"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    wire:model="cuenta.numero">
                                <x-jet-input-error for="cuenta.numero" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="banco_id" class="block text-sm font-medium text-gray-700">Banco:</label>
                                <select id="banco_id" name="banco_id" class="form-control w-full"
                                    wire:model="cuenta.banco_id">
                                    <option value="0"> -- </option>
                                    @foreach ($bancos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="cuenta.banco_id" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de
                                    cuenta:</label>
                                <select id="tipo" name="tipo" class="form-control w-full" wire:model="cuenta.tipo">
                                    <option value="0"> -- </option>
                                    <option value="Ahorro">Ahorro</option>
                                    <option value="Corriente">Corriente</option>
                                </select>
                                <x-jet-input-error for="cuenta.tipo" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono afiliado
                                    a pago móvil</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center">
                                        <select wire:model="codigo" id="codigo" name="codigo"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                            <option>0412</option>
                                            <option>0414</option>
                                            <option>0416</option>
                                            <option>0424</option>
                                            <option>0426</option>
                                        </select>
                                    </div>
                                    <input wire:model.lazy="telefono" type="text" name="telefono" id="telefono"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <x-jet-input-error for="telefono" />
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm font-medium text-gray-700">
                                    ¿Mostrar los datos de la cuenta a los propietarios?
                                </label>
                                <div>
                                    <input wire:model="cuenta.publica" type="radio" name="publica" id="si" value="1">
                                    <label for="si">Sí</label>
                                    <input wire:model="cuenta.publica" type="radio" name="publica" id="no" value="0"
                                        class="ml-2">
                                    <label for="no">No</label>
                                </div>
                                <x-jet-input-error for="cuenta.publica" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- /formulario --}}


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('openEdit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="openDestroy">

        <x-slot name="title">
            Eliminar
        </x-slot>

        <x-slot name="content">
            ¿Seguro que desea eliminar la cuenta?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openDestroy', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="delete" wire:loading.attr="disabled" class="disabled:opacity-25">
                Eliminar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-confirmation-modal>

</div>
