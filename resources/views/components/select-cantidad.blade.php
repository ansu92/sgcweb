@props([
	'cantidad'
])

<div class="flex items-center text-sm">
	<span>Mostrar</span>

	<select wire:model="cantidad" class="mx-2 form-control">
		<option value="10">10</option>
		<option value="25">25</option>
		<option value="50">50</option>
		<option value="100">100</option>
	</select>
</div>
