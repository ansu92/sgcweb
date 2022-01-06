<div class="bg-white overflow-hidden  shadow-xl rounded-xl">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Unidad
        </h3>
    </div>
    <div class="border-t border-gray-200">
        <dl>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Número:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $unidad->numero }}
                </dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Dirección:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $unidad->direccion }}
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Tipo de unidad:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $unidad->tipoUnidad->nombre }}
                </dd>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Área:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $unidad->tipoUnidad->area }} m2
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Número de documento:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $unidad->documento }}
                </dd>
            </div>

        </dl>
    </div>

    {{-- Tabla habitantes de la unidad --}}
    <div class="border rounded-md shadow-md m-4">

        <div class="flex items-center px-4 py-2">
            <h2 class="px-4 py-2 text-lg inline w-full">Habitantes de la unidad</h2>

            @livewire('nuevo-integrante', ['unidad' => $unidad])
        </div>

        @if (count($unidad->integrantes))

            <!-- tabla -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Propietario</span>
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Cédula
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Apellido
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($unidad->integrantes as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    @if ($unidad->propietario->integrante->id == $item->id)
                                                        <i class="fas fa-home text-xl text-blue-400"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($item->documento != '')
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->letra }}-{{ $item->documento }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->nombre }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->apellido }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium space-x-1">
                                                <a href="{{ route('integrante.show', $item) }}"
                                                    class="btn btn-blue">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-green" wire:click="edit({{ $item }})">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a class="btn btn-red"
                                                    wire:click="removerIntegrante({{ $item }})">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /tabla --}}

        @else
            <div class="px-4 py-2">
                Sin habitantes
            </div>
        @endif

        {{-- Modal modificar integrante --}}
        <x-jet-dialog-modal wire:model="openEdit">
            <x-slot name="title">
                Editar el integrante
            </x-slot>

            <x-slot name="content">
                <div class="mt-10 sm:mt-0">

                    {{-- formulario --}}
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="documento"
                                        class="block text-sm font-medium text-gray-700">Cédula:</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 flex items-center">
                                            <select wire:model="letra" id="letra" name="letra"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                                                <option>V</option>
                                                <option>E</option>
                                            </select>
                                        </div>
                                        <input wire:model="integrante.documento" type="text" name="documento"
                                            id="documento"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <x-jet-input-error for="integrante.documento" />
                                </div>

                                <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                                    <input wire:model="integrante.nombre" type="text" name="nombre" id="nombre"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="integrante.nombre" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="s_nombre" class="block text-sm font-medium text-gray-700">Segundo
                                        nombre:</label>
                                    <input wire:model="integrante.s_nombre" type="text" name="s_nombre" id="s_nombre"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="integrante.s_nombre" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="apellido"
                                        class="block text-sm font-medium text-gray-700">Apellido:</label>
                                    <input wire:model="integrante.apellido" type="text" name="apellido" id="apellido"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="integrante.apellido" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="s_apellido" class="block text-sm font-medium text-gray-700">Segundo
                                        apellido:</label>
                                    <input wire:model="integrante.s_apellido" type="text" name="s_apellido"
                                        id="s_apellido"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="integrante.s_apellido" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha
                                        de
                                        nacimiento:</label>
                                    <input wire:model="integrante.fecha_nacimiento" type="date" name="fecha_nacimiento"
                                        id="fecha_nacimiento"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="integrante.fecha_nacimiento" />
                                </div>

                                <div class="col-span-6 sm:col-span-3 sm:col-start-1">
                                    <label for="telefono"
                                        class="block text-sm font-medium text-gray-700">Teléfono</label>
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
                                        <input wire:model="telefono" type="text" name="telefono" id="telefono"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <x-jet-input-error for="telefono" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input wire:model="integrante.email" type="text" name="email" id="email"
                                        autocomplete="email"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <x-jet-input-error for="integrante.email" />
                                </div>

                                <h3 class="col-span-6 text-center">Enfermedades que padece</h3>

                                <div class="col-span-6 grid grid-cols-4">
                                    @foreach ($listaEnfermedades as $item)
                                        <div>
                                            <input wire:model="enfermedades" type="checkbox"
                                                name="{{ $item->nombre }}" id="{{ $item->nombre }}"
                                                value="{{ $item->id }}" class="form-control">
                                            <label for="{{ $item->nombre }}"
                                                class=" text-sm font-medium text-gray-700">{{ $item->nombre }}</label>
                                        </div>
                                    @endforeach
                                    <x-jet-input-error for="enfermedades" />
                                </div>

                                <h3 class="col-span-6 text-center">Medicamentos que utiliza</h3>

                                <div class="col-span-6 grid grid-cols-4">
                                    @foreach ($listaMedicamentos as $item)
                                        <div>
                                            <input wire:model="medicamentos" type="checkbox"
                                                name="{{ $item->nombre }}" id="{{ $item->nombre }}"
                                                value="{{ $item->id }}" class="form-control">
                                            <label for="{{ $item->nombre }}"
                                                class=" text-sm font-medium text-gray-700">{{ $item->nombre }}</label>
                                        </div>
                                    @endforeach
                                    <x-jet-input-error for="medicamentos" />
                                </div>

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

                <x-jet-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                    Actualizar
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>

        {{-- Modal eliminar integrante --}}
        <x-jet-confirmation-modal wire:model="openDestroy">

            <x-slot name="title">
                Remover
            </x-slot>

            <x-slot name="content">
                ¿Seguro que desea remover al integrante de la unidad?
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('openDestroy', false)">
                    Cancelar
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="remove" wire:loading.attr="disabled" class="disabled:opacity-25">
                    Remover
                </x-jet-danger-button>
            </x-slot>

        </x-jet-confirmation-modal>

    </div>

    {{-- Tabla facturas pendientes --}}
    <div class="border rounded-md shadow-md m-4">

        <div class="flex items-center px-4 py-2">
            <h2 class="px-4 py-2 text-lg inline w-full">Facturas pendientes</h2>
        </div>

        @if (count($unidad->facturas))
            <!-- tabla -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Número de factura
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Monto
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($unidad->facturas as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->numero }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->fecha }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->montoFormateado }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium space-x-1">
                                                <a href="{{ route('factura.show', $item) }}" class="btn btn-blue">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /tabla --}}

        @else
            <div class="px-4 py-2">
                Sin facturas pendientes
            </div>
        @endif

    </div>

</div>
