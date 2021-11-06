<div wire:init="$set('readyToLoad', true)">

    <div class="space-y-4">
        <div class="flex space-x-4 items-center">
            <x-select-cantidad />

            <div class="flex flex-wrap">
                <div class="w-full sm:w-6/12 md:w-4/12">
                    <div class="relative inline-flex align-middle w-full">

                        {{-- Botón --}}
                        <button class="btn btn-blue" type="button" onclick="openDropdown(event,'dropdown-example-1')">
                            Exportar<i class="fas fa-file-export"></i>
                        </button>

                        {{-- Contenido --}}
                        <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
                            style="min-width: 12rem" id="dropdown-example-1">

                            <a href="{{ route('unidad.exportar-con-propietario') }}"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                Lista de unidades con propietario
                            </a>

                            <a href="{{ route('unidad.exportar-sin-propietario') }}"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                Lista de unidades sin propietario
                            </a>

                            <a href="{{ route('unidad.exportar-con-habitantes') }}"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                Lista de unidades habitadas
                            </a>

                            <a href="{{ route('unidad.exportar-sin-habitantes') }}"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                                Lista de unidades sin habitantes
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Required popper.js -->
            <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
            <script>
                function openDropdown(event, dropdownID) {
                    let element = event.target;
                    while (element.nodeName !== "BUTTON") {
                        element = element.parentNode;
                    }
                    var popper = Popper.createPopper(
                        element,
                        document.getElementById(dropdownID), {
                            placement: "bottom-start",
                        }
                    );
                    document.getElementById(dropdownID).classList.toggle("hidden");
                    document.getElementById(dropdownID).classList.toggle("block");
                }
            </script>

            <x-jet-input wire:model="busqueda" type="text" placeholder="Escriba para buscar..."
                class="w-full" />

            @livewire('admin.unidad.nueva-unidad')
        </div>

        @if ($readyToLoad)

            @if (count($unidades))

                <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-3">
                    @foreach ($unidades as $item)
                        <a href="{{ route('admin.unidad.show', $item) }}">
                            <x-card-unidad :unidad="$item" />
                        </a>
                    @endforeach
                </div>

                @if ($unidades->hasPages())
                    <div class="px-6 py-3">
                        {{ $unidades->links() }}
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
