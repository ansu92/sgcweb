{{-- formulario --}}
<div class="shadow overflow-hidden sm:rounded-md">
    <div class="px-4 py-5 bg-white sm:p-6">
        <div class="grid grid-cols-6 gap-6">

            <div class="col-span-6 sm:col-span-3">
                <label for="unidad" class="block text-sm font-medium text-gray-700">Unidad:</label>
                <input type="text" name="unidad" id="unidad" value="{{ $unidad->numero }}"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    readonly>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="documento-unidad" class="block text-sm font-medium text-gray-700">Número de
                    documento:</label>
                <input wire:model="documento" type="text" name="documento-unidad" id="documento-unidad"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-jet-input-error for="documento" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="documento" class="block text-sm font-medium text-gray-700">Cédula:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center">
                        <select wire:model="letra" id="letra" name="letra"
                            class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                            <option>V</option>
                            <option>E</option>
                        </select>
                    </div>
                    <input wire:model.lazy="ci" type="text" name="documento" id="documento"
                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md">
                </div>
                <x-jet-input-error for="ci" />
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
                    autocomplete="street-address"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-jet-input-error for="integrante.s_nombre" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                <input wire:model="integrante.apellido" type="text" name="apellido" id="apellido"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-jet-input-error for="integrante.apellido" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="s_apellido" class="block text-sm font-medium text-gray-700">Segundo
                    apellido:</label>
                <input wire:model="integrante.s_apellido" type="text" name="s_apellido" id="s_apellido"
                    autocomplete="street-address"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-jet-input-error for="integrante.s_apellido" />
            </div>

			<div class="col-span-6 sm:col-span-3">
				<label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700">Fecha de
					nacimiento:</label>
				<input wire:model="integrante.fecha_nacimiento" type="date" name="fecha_nacimiento"
					id="fecha_nacimiento"
					class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
				<x-jet-input-error for="integrante.fecha_nacimiento" />
			</div>

            <div class="col-span-6 sm:col-span-3">
                <label for="edad" class="block text-sm font-medium text-gray-700">Edad:</label>
                <input wire:model="edad" type="text" name="edad"
                    id="edad" readonly
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-jet-input-error for="edad" />
            </div>

            <div class="col-span-6 sm:col-span-3  sm:col-start-1">
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
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
                <input wire:model="integrante.email" type="text" name="email" id="email" autocomplete="email"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                <x-jet-input-error for="integrante.email" />
            </div>

        </div>
    </div>
</div>
{{-- /formulario --}}
