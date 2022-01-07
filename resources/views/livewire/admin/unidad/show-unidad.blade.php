<div class="bg-white overflow-hidden  shadow-xl rounded-xl">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Unidad
        </h3>
    </div>

    @if ($unidad->propietario)
        <div class="px-4 py-3 sm:px-6">
            <x-jet-button wire:click="$set('openCambiar', true)">
                Cambio de propietario
            </x-jet-button>

            <x-jet-danger-button wire:click="$set('openRetirar', true)">
                Retirar propietario
            </x-jet-danger-button>
        </div>
    @else
        <div class="px-4 py-3 sm:px-6">
            <x-jet-button wire:click="$set('openAsignar', true)">
                Asignar propietario
            </x-jet-button>
        </div>
    @endif

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

            @if ($unidad->propietario)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Propietario:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $unidad->propietario->integrante->nombre }}
                        {{ $unidad->propietario->integrante->apellido }}
                    </dd>
                </div>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Número de documento:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $unidad->documento }}
                    </dd>
                </div>
            @endif

        </dl>
    </div>

    @if ($unidad->propietario)
        <div class="border rounded-md shadow-md m-4">

            @if (count($unidad->integrantes))
                <div class="flex items-center px-4 py-2">
                    <h2 class="px-4 py-2 text-lg inline w-full">Habitantes de la unidad</h2>
                </div>

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
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $item->letra }}-{{ $item->documento }}
                                                    </div>
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
                                                    {{-- <a class="btn btn-red" wire:click="destroy({{ $item }})">
                                                    <i class="fas fa-times"></i>
                                                </a> --}}
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

        </div>

    @endif

    <x-jet-dialog-modal wire:model="openAsignar">

        <x-slot name="title">
            Asignar propietario
        </x-slot>

        <x-slot name="content">

            <div class="mt-10 sm:mt-0">
                @include('livewire.admin.unidad.partials.form-propietario')
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openAsignar', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="asignarPropietario" wire:loading.attr="disabled" class="disabled:opacity-25">
                Asignar propietario
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="openCambiar">

        <x-slot name="title">
            Cambiar propietario
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                @include('livewire.admin.unidad.partials.form-propietario')
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openAsignar', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="cambiarPropietario" wire:loading.attr="disabled" class="disabled:opacity-25">
                Cambiar propietario
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="openRetirar">

        <x-slot name="title">
            Retirar propietario
        </x-slot>

        <x-slot name="content">
            <p>¿Seguro que desea retirar al propietario de la unidad?</p>
            <p>Esto retirará también a todos los habitantes y dejará la unidad vacía.</p>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openRetirar', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="retirar" wire:loading.attr="disabled" class="disabled:opacity-25">
                Retirar propietario
            </x-jet-danger-button>
        </x-slot>

    </x-jet-confirmation-modal>

    {{-- <x-jet-confirmation-modal wire:model="openDestroy">

		<x-slot name="title">
			Eliminar
		</x-slot>

		<x-slot name="content">
			¿Seguro que desea eliminar al integrante de la unidad?
		</x-slot>

		<x-slot name="footer">
			<x-jet-secondary-button wire:click="$set('openDestroy', false)">
				Cancelar
			</x-jet-secondary-button>

			<x-jet-danger-button wire:click="remove" wire:loading.attr="disabled" class="disabled:opacity-25">
				Eliminar
			</x-jet-danger-button>
		</x-slot>

	</x-jet-confirmation-modal> --}}

</div>
