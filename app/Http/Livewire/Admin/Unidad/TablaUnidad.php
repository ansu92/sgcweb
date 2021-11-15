<?php

namespace App\Http\Livewire\Admin\Unidad;

use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class TablaUnidad extends Component
{
	use WithPagination;

	public $unidad;

	public $busqueda = '';
	public $cantidad = '10';

	public $readyToLoad = false;

	protected $listeners = ['render'];

	public $propietario = '2';
	public $habitantes = '2';
	public $facturas = '2';

	public function mount()
	{
		$this->unidad = new Unidad;
	}

	public function render()
	{
		$unidades = $this->filtrar();

		if ($this->readyToLoad) {

			if ($unidades->count()) {

				$unidades = $unidades->toQuery()
					->where(function ($query) {
						$query->where('numero', 'LIKE', '%' . $this->busqueda . '%')
							->orWhere('direccion', 'LIKE', '%' . $this->busqueda . '%');
					})
					->orderBy('numero', 'asc')
					->paginate($this->cantidad);
			} else {
				$unidades = [];
			}
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

	private function filtrar()
	{
		$unidades = Unidad::all();

		switch ($this->habitantes) {
			case '0':
				$unidades = $unidades->intersect(Unidad::doesntHave('integrantes')->get());
				break;

			case '1':
				$unidades = $unidades->intersect(Unidad::has('integrantes')->get());
				break;

			default:
				# code...
				break;
		}

		switch ($this->propietario) {
			case '0':
				$unidades = $unidades->intersect(Unidad::doesntHave('propietario')->get());
				break;

			case '1':
				$unidades = $unidades->intersect(Unidad::has('propietario')->get());
				break;

			default:
				# code...
				break;
		}

		switch ($this->facturas) {
			case '0':
				$unidades = $unidades->intersect(Unidad::doesntHave('facturas')->get());
				break;

			case '1':
				$unidades = $unidades->intersect(Unidad::has('facturas')->get());
				break;

			default:
				# code...
				break;
		}

		return $unidades;
	}
}
