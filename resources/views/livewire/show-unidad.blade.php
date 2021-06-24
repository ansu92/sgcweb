<div>
	<h1 class="text-xl font-bold">{{ $unidad->numero }}</h1>
	Dirección: {{ $unidad->direccion }}

	<h2>Habitantes</h2>

	<!-- tabla -->
	<div class="flex flex-col">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
				<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
					@if(count($unidad->integrantes))
					<table class="min-w-full divide-y divide-gray-200">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col"
									class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
									wire:click="orden('numero')">
									Documento

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
										{{ $item->documento }}
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
								<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-1">
									<a href="#" class="btn btn-blue">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-green">
										<i class="fas fa-edit"></i>
									</a>
									<a href="#" class="btn btn-red">
										<i class="fas fa-trash"></i>
									</a>
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