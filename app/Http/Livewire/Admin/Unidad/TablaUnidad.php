<?php

namespace App\Http\Livewire\Admin\Unidad;

use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class TablaUnidad extends Component
{
	use WithPagination;

	public $unidad;

	public $busqueda;
	public $orden = 'numero';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	protected $listeners = ['render'];

	public function mount()
	{
		$this->unidad = new Unidad;
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$unidades = Unidad::where('numero', 'LIKE', '%' . $this->busqueda . '%')
				->orWhere('direccion', 'LIKE', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
				// $unidades = Unidad::doesntHave('propietario');
			} else {
			$unidades = [];
		}

		return view('livewire.admin.unidad.tabla-unidad', compact('unidades'));
	}

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad()
	{
		$this->resetPage();
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
