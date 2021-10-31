<div class="bg-white overflow-hidden  shadow-xl rounded-xl">

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">

        {{-- titulo --}}
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $condominio->nombre }}
            </h3>
            <span class="mt-1 max-w-2xl text-sm text-gray-500">RIF:</span>
            <span class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ $condominio->rif }}
            </span>
        </div>

        {{-- informacion --}}
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Unidad:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->unidad->numero }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Fecha:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->fecha }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            N° de Factura:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->id }}
                        </dd>
                    </div>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Nombre:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->unidad->propietario->integrante->nombre }}
                            {{ $factura->unidad->propietario->integrante->apellido }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Documento de identidad:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->unidad->propietario->integrante->letra }}-{{ $factura->unidad->propietario->integrante->documento }}
                        </dd>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Dirección:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->unidad->direccion }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Teléfono:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->unidad->propietario->integrante->telefono }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Correo:
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $factura->unidad->propietario->integrante->email }}
                        </dd>
                    </div>
                </div>
            </dl>
        </div>
    </div>
    {{-- tabla --}}
    <div class="flex flex-col my-4 mx-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Monto
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($factura->items as $item)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ ++$countItems }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            @switch(Str::substr($item->itemable_type, 11))

                                                @case(Mensualidad::class)
                                                    {{ Str::substr($item->itemable_type, 11) }}
                                                    ({{ Str::substr($item->itemable->fecha, 0, 7) }})
                                                @break

                                                @case(Gasto::class)
                                                    {{ Str::substr($item->itemable_type, 11) }}
                                                    ({{ $item->itemable->descripcion }})
                                                @break

                                                @case(Sancion::class)
                                                    {{ Str::substr($item->itemable_type, 11) }}
                                                    ({{ $item->itemable->descripcion }})
                                                @break

                                            @endswitch
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $item->montoSinIva }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 border-r border-gray-200 text-right text-xs text-gray-800 font-black uppercase tracking-wider">
                                    Subtotal:
                                </th>
                                <th scope="col"
                                    class="bg-white px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $sub }}
                                    </div>
                                </th>
                            </tr>
                            @if ($factura->interes)
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 border-r border-gray-200 text-right text-xs text-gray-800 font-black uppercase tracking-wider">
                                        Interés ({{ $factura->interes->factor }}%):
                                    </th>
                                    <th scope="col"
                                        class="bg-white px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $montoInteres }}
                                        </div>
                                    </th>
                                </tr>
								<tr>
									<th scope="col"
										class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									</th>
									<th scope="col"
										class="px-6 py-3 border-r border-gray-200 text-right text-xs text-gray-800 font-black uppercase tracking-wider">
										Subtotal (interés aplicado):
									</th>
									<th scope="col"
										class="bg-white px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										<div class="text-sm font-medium text-gray-900">
											{{ $subConInteres }}
										</div>
									</th>
								</tr>
								@endif
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 border-r border-gray-200 text-right text-xs text-gray-800 font-black uppercase tracking-wider">
                                    IVA ({{ $factura->iva->factor }}%):
                                </th>
                                <th scope="col"
                                    class="bg-white px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $montoIva }}
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 border-r border-gray-200 text-right text-xs text-gray-800 font-black uppercase tracking-wider">
                                    Total:
                                </th>
                                <th scope="col"
                                    class="bg-white px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $total }}
                                    </div>
                                </th>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
