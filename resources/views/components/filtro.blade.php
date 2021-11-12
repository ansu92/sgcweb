<div>
    <div class="flex flex-wrap">
        <div class="w-full sm:w-6/12 md:w-4/12">
            <div class="relative inline-flex align-middle w-full">

                {{-- Botón --}}
                <button class="btn btn-blue whitespace-nowrap" type="button"
                    onclick="openDropdown(event,'dropdown-example-1')">
                    Filtrar <i class="fas fa-filter"></i>
                </button>

                {{-- Contenido --}}
                <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1 space-y-4"
                    style="min-width: 12rem" id="dropdown-example-1">

                    {{ $contenido }}

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
</div>
