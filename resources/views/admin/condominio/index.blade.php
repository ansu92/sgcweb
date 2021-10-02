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

                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Actualizar
                                </button>
                            </div>

                        </div>
                    </form>
                    {{-- /formulario --}}

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
