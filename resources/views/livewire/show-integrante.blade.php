<div class="px-4">
    <div class="py-2">
		Cédula: {{ $integrante->documento }}
	</div>
    <div class="py-2">
		Nombre: {{ $integrante->nombre }} {{ $integrante->s_nombre }} {{ $integrante->apellido }} {{ $integrante->s_apellido }}
	</div>
    <div class="py-2">
		Teléfono: {{ $integrante->telefono }}
	</div>
    <div class="py-2">
		Correo: {{ $integrante->email }}
	</div>
    <div class="py-2">
		Dirección: {{ $integrante->unidad->direccion }}
	</div>
</div>
