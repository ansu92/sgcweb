<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Condominio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div>

                    {{-- formulario --}}
                    <form action="{{ route('admin.condominio.store') }}" method="POST">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    @csrf

                                    <h3 class="col-span-6 text-center">Datos del condominio</h3>

                                    <div class="col-span-6">
                                        <label for="rif" class="block text-sm font-medium text-gray-700">RIF:</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 flex items-center">
                                                <select id="letra" name="letra"
                                                    class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md"
                                                    disabled>
                                                    <option value="J">J</option>
                                                </select>
                                            </div>
                                            <input type="text" name="rif" id="rif"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        <x-jet-input-error for="rif" />
                                    </div>

                                    <div class="col-span-6">
                                        <label for="nombre"
                                            class="block text-sm font-medium text-gray-700">Nombre:</label>
                                        <input type="text" name="nombre" id="nombre"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <x-jet-input-error for="nombre" />
                                    </div>

                                    <div class="col-span-6">
                                        <label for="direccion"
                                            class="block text-sm font-medium text-gray-700">Dirección:</label>
                                        <input type="text" name="direccion" id="direccion"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <x-jet-input-error for="direccion" />
                                    </div>

                                    <h3 class="col-span-6 text-center">Tasa de cambio inicial</h3>

                                    <div class="col-span-6">
                                        <label for="tasa" class="block text-sm font-medium text-gray-700">
                                            Tasa de cambio:
                                        </label>
                                        <input type="text" name="tasa" id="tasa" class="form-control w-full">
                                        <x-jet-input-error for="tasa" />
                                    </div>

                                    <h3 class="col-span-6 text-center">Mensualidad inicial</h3>

                                    <div class="col-span-6">
                                        <label for="monto" class="block text-sm font-medium text-gray-700">
                                            Monto:
                                        </label>
                                        <input type="text" name="monto" id="monto" class="form-control w-full">
                                        <x-jet-input-error for="monto" />
                                    </div>

                                    <div class="col-span-6">
                                        <label for="moneda" class="block text-sm font-medium text-gray-700">
                                            Moneda:
                                        </label>
                                        <select name="moneda" id="moneda" class="form-control w-full">
                                            <option>Bolívar</option>
                                            <option>Dólar</option>
                                        </select>
                                        <x-jet-input-error for="moneda" />
                                    </div>

                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-jet-button type="submit">
                                    Registrar
                                </x-jet-button>
                            </div>

                        </div>
                    </form>
                    {{-- /formulario --}}

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
