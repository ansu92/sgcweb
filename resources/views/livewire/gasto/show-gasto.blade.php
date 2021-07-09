<div wire:init="$set('readyToLoad', true)">
    <div class="bg-white overflow-hidden  shadow-xl rounded-xl">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Gasto
            </h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Descripción:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $gasto->descripcion }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tipo:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $gasto->extraordinario ? 'Extraordinario' : 'Ordinario' }}
                    </dd>
                </div>

                @if ($gasto->extraordinario)

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Número de meses:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $gasto->extraordinario->num_meses }}
                        </dd>
                    </div>

                    @if ($gasto->extraordinario->asamblea)
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">
                                Asamblea:
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $gasto->extraordinario->asamblea->descripcion }}
                                {{ $gasto->extraordinario->asamblea->fecha }}
                            </dd>
                        </div>
                    @endif

                @endif

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Cálculo por:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $gasto->calculo_por }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Comienzo de cobro:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $gasto->mes_cobro }}
                    </dd>
                </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Moneda:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $gasto->moneda }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Monto:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $gasto->monto }}
                    </dd>
                </div>

                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Observaciones:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $gasto->observaciones }}
                    </dd>
                </div>

            </dl>
        </div>

        <div class="border rounded-md shadow-md my-2 mx-4">

            <div class="space-y-4 p-4">
                <div class="flex space-x-4 items-center">

                    <x-select-cantidad />

                    <x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full"
                        wire:model="busqueda" />

                </div>

                <!-- tabla -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                @if ($readyToLoad)
                                    @if (count($servicios))
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                        wire:click="orden('nombre')">
                                                        Nombre

                                                        @if ($orden == 'nombre')

                                                            @if ($direccion == 'asc')
                                                                <i
                                                                    class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                            @else
                                                                <i
                                                                    class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                                            @endif

                                                        @else
                                                            <i class="fas fa-sort float-right mt-1"></i>
                                                        @endif
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                                                        wire:click="orden('descripcion')">
                                                        Descripción
                                                        @if ($orden == 'descripcion')

                                                            @if ($direccion == 'asc')
                                                                <i
                                                                    class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

                                                            @else
                                                                <i
                                                                    class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

                                                            @endif

                                                        @else
                                                            <i class="fas fa-sort float-right mt-1"></i>

                                                        @endif
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                        Categoría
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                        Monto
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-3">
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($servicios as $item)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->nombre }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->descripcion }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->categoria->nombre }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->pivot->monto }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap space-x-1 text-xs">
                                                            <a href="{{ route('servicio.show', $item) }}"
                                                                class="btn btn-blue">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if ($servicios->hasPages())
                                            <div class="px-6 py-3">
                                                {{ $servicios->links() }}
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

            </div>
        </div>

    </div>
