<?php

namespace App\Http\Livewire\Gasto;

use App\Models\Gasto;
use Livewire\Component;
use Livewire\WithPagination;

class ShowGasto extends Component
{
	use WithPagination;

	public Gasto $gasto;

	public $readyToLoad = false;

	public $busqueda;
	public $orden = 'nombre';
	public $direccion = 'asc';
	public $cantidad = '10';

	public function render()
	{
		$servicios = $this->readyToLoad
			?
			$this->gasto->servicios()
			->where(function ($query) {
				$query->where('nombre', 'LIKE', '%' . $this->busqueda . '%')
					->orWhere('descripcion', 'LIKE', '%' . $this->busqueda . '%');
			})
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad)
			:

			$servicios = [];

		return view('livewire.gasto.show-gasto', compact('servicios'));
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
