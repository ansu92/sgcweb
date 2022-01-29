<div>

    <div wire:click="$set('open', true)">
        <x-btn-admin-ancho nombre="Reportes" icono="/img/iconos/iva.png" />
    </div>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Reportes
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="flex flex-col gap-4">
                        <div class="flex justify-between p-4 border shadow rounded">
                            <h4 class="inline text-lg">Saldo total</h4>
                            <div>
                                <a href="{{ route('reporte.saldoTotal', 1) }}" target="_blank"
                                    class="btn btn-blue">Ver</a>
                                <a href="{{ route('reporte.saldoTotal', 2) }}" class="btn btn-blue">Descargar</a>
                            </div>
                        </div>

                        <div class="flex justify-between p-4 border shadow rounded">
                            <h4 class="inline text-lg">Unidades con facturas pendientes</h4>
                            <div>
                                <a href="{{ route('reporte.con-facturas-pendientes', 1) }}" target="_blank"
                                    class="btn btn-blue">Ver</a>
                                <a href="{{ route('reporte.con-facturas-pendientes', 2) }}" class="btn btn-blue">Descargar</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- /formulario --}}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
