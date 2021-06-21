<?php

namespace App\Http\Livewire;

use App\Models\Unidad;
use Livewire\Component;

class TablaUnidad extends Component
{
	public $busqueda;
	public $orden = 'numero';
	public $direccion = "desc";

	protected $listeners = ['render'];

	public function render()
	{
		$unidades = Unidad::select()
			->orderBy($this->orden, $this->direccion)
			->get();

		return view('livewire.tabla-unidad', compact('unidades'));
	}

	public function orden($orden)
	{
		if ($this->orden == $orden) {
			if ($this->direccion == 'desc') {
				$this->direccion = 'asc';
			} else {
				$this->direccion = 'desc';
			}
		} else {
			$this->orden = $orden;
			$this->direccion = 'asc';
		}
	}
}
