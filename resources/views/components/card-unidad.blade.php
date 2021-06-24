<div class="flex flex-col shadow-md rounded bg-gray-50">
	<div class="px-2 py-1 bg-yellow-500 rounded-t text-white">
		{{ $numero }}
	</div>
	<div class="px-2 py-1 text-sm space-y-2">
		<div>
			{{ $direccion }}
		</div>
		<div>
			<span class="text-xs">Propietario: </span>{{ $propietario }}
		</div>
		<div>
			{{ $numHabitantes }}

			@if($numHabitantes > '1')
				<span class="text-xs"> habitantes</span>
			@else
				<span class="text-xs"> habitante</span>
			@endif
		</div>
	</div>
</div>