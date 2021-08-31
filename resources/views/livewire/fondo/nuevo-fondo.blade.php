<div>

    <x-jet-button wire:click="$set('open', true)">
        Nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Nuevo fondo
        </x-slot>

        <x-slot name="content">
            <div class="mt-10 sm:mt-0">

                {{-- formulario --}}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6">
                                <label for="descripcion"
                                    class="block text-sm font-medium text-gray-700">Descripción:</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control w-full"
                                    wire:model="descripcion">
                                <x-jet-input-error for="descripcion" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="saldo-inicial" class="block text-sm font-medium text-gray-700">Saldo
                                    inicial:</label>
                                <input type="number" name="saldo-inicial" id="saldo-inicial" class="form-control w-full"
                                    wire:model="saldoInicial">
                                <x-jet-input-error for="saldoInicial" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="moneda" class="block text-sm font-medium text-gray-700">Moneda:</label>
                                <select name="moneda" id="moneda" class="form-control w-full" wire:model="moneda">
                                    <option>Bolívar</option>
                                    <option>Dólar</option>
                                </select>
                                <x-jet-input-error for="moneda" />
                            </div>

                            <div class="col-span-6">
                                <label for="cuenta" class="block text-sm font-medium text-gray-700">Cuenta afiliada:</label>
                                <select wire:model="cuenta.id" name="cuenta" id="cuenta" class="form-control w-full">
                                    <option>----</option>
                                    @foreach ($cuentas as $item)
                                        <option value="{{ $item->id }}">{{ $item->numero }} - {{ $item->banco->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="cuenta.id" />
                            </div>

                        </div>
                    </div>
                </div>
                {{-- /formulario --}}

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
