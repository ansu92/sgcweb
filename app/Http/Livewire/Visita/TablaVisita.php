<?php

namespace App\Http\Livewire\Visita;

use App\Models\Visita;
use Livewire\Component;
use Livewire\WithPagination;

class TablaVisita extends Component
{
	use WithPagination;

	public Visita $visita;

	public $busqueda;
	public $orden = 'fecha_hora_entrada';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $listeners = ['render'];

	public function render()
	{
		$visitas = Visita::whereNull('fecha_hora_salida')->paginate($this->cantidad);

		return view('livewire.visita.tabla-visita', compact('visitas'));
	}

	public function registrarSalida(Visita $visita) {
		$visita->fecha_hora_salida = now();
		$visita->save();

		$this->emit('alert', 'La salida se registró satisfactoriamente');
	}
}
