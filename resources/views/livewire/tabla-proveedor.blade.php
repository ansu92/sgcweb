<div>
	{{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

	<div class="space-y-4">
		<div class="flex space-x-4 items-center">
			<x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />

			@livewire('nuevo-proveedor')
		</div>

		<!-- tabla -->
		<div class="flex flex-col">
			<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
				<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
					<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
						@if($proveedores->count())
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
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
										class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
										wire:click="orden('nombre')">
										Nombre
										@if ($orden == 'nombre')

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
										wire:click="orden('contacto')">
										Contacto
										@if ($orden == 'contacto')

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
										wire:click="orden('telefono')">
										Teléfono
										@if ($orden == 'telefono')

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
										wire:click="orden('email')">
										E-mail
										@if ($orden == 'email')

										@if ($direccion == 'asc')
										<i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>

										@else
										<i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>

										@endif

										@else
										<i class="fas fa-sort float-right mt-1"></i>

										@endif
									</th>
									<th scope="col" class="relative px-6 py-3">
										<span class="sr-only">Edit</span>
									</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								@foreach ($proveedores as $item)
								<tr>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="text-sm font-medium text-gray-900">
											{{ $item->documento }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="text-sm font-medium text-gray-900">
											{{ $item->nombre }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="text-sm font-medium text-gray-900">
											{{ $item->contacto }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="text-sm font-medium text-gray-900">
											{{ $item->telefono }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="text-sm font-medium text-gray-900">
											{{ $item->email }}
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<x-boton color="blue">
											<i class="fas fa-search"></i>
										</x-boton>
										<x-boton color="yellow">
											<i class="fas fa-edit"></i>
										</x-boton>
										<x-boton color="red">
											<i class="fas fa-trash"></i>
										</x-boton>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@else
						Su búsqueda no tuvo resultado
						@endif
					</div>
				</div>
			</div>
		</div>
		{{-- /tabla --}}
	</div>

</div>