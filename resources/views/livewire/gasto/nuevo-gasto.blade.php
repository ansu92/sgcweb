<div wire:init="$toggle('readyToLoad')">

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Nuevo gasto
        </x-slot>

        <x-slot name="content">

			{{-- formulario --}}
            <div class="mt-10 sm:mt-0">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-4">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                    Descripción:
                                </label>
                                <input wire:model="descripcion" type="text" name="descripcion" id="descripcion" class="form-control w-full">
								<x-jet-input-error for="descripcion" />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="monto" class="block text-sm font-medium text-gray-700">
                                    Monto:
                                </label>
                                <input wire:model="monto" type="text" name="monto" id="monto" class="form-control w-full">
								<x-jet-input-error for="monto" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="fecha" class="block text-sm font-medium text-gray-700">
                                    Fecha:
                                </label>
                                <input wire:model="fecha" type="date" name="fecha" id="fecha" class="form-control w-full">
								<x-jet-input-error for="fecha" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="factura" class="block text-sm font-medium text-gray-700">
                                    Número de factura:
                                </label>
                                <input wire:model="factura" type="text" name="factura" id="factura" class="form-control w-full">
								<x-jet-input-error for="factura" />
                            </div>

                            <div class="col-span-6">
                                <label for="observaciones" class="block text-sm font-medium text-gray-700">
                                    Observaciones:
                                </label>
                                <textarea wire:model="observaciones" name="observaciones" id="observaciones" rows="5" class="form-control w-full"></textarea>
								<x-jet-input-error for="observaciones" />
                            </div>

							<div class="col-span-6">
								<label class="block text-sm font-medium text-gray-700">Servicios {{count($servicios)}}</label>
								<x-jet-input-error for="servicios" />

								<div class="space-y-4">
									<div class="flex space-x-4 items-center">
										<x-select-cantidad />
							
										<x-jet-input type="text" placeholder="Escriba para buscar..." class="w-full" wire:model="busqueda" />
									</div>
							
									<!-- tabla -->
									<div class="flex flex-col">
										<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
											<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
												<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
													@if ($readyToLoad)
														@if (count($listaServicios))
															<table class="min-w-full divide-y divide-gray-200">
																<thead class="bg-gray-50">
																	<tr>
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
																			wire:click="orden('descripcion')">
																			Descripción
																			@if ($orden == 'descripcion')
							
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
																			Categoría
																		</th>
																		<th scope="col" class="relative px-6 py-3">
																			<span class="sr-only">Selección</span>
																		</th>
																	</tr>
																</thead>
																<tbody class="bg-white divide-y divide-gray-200">
																	@foreach ($listaServicios as $item)
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
																			<td class="px-6 py-4 whitespace-nowrap space-x-1 text-xs">
																				<input wire:model="servicios" type="checkbox" name="servicio_{{ $item->id }}" id="servicio_{{ $item->id }}" value="{{ $item->id }}" class="form-control">
																			</td>
																		</tr>
																	@endforeach
																</tbody>
															</table>
							
															@if ($listaServicios->hasPages())
																<div class="px-6 py-3">
																	{{ $listaServicios->links() }}
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
							
							</div>

                        </div>
                    </div>
                </div>
            </div>
			{{-- /formulario --}}

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button>
                Registrar
            </x-jet-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
