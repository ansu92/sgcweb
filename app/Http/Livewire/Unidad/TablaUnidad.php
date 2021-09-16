<?php

namespace App\Http\Livewire\Unidad;

use App\Models\Unidad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TablaUnidad extends Component
{
	public $unidad;

	public $busqueda;
	public $orden = 'numero';
	public $direccion = "asc";

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'categoria.nombre' => 'required|max:25',
		'categoria.descripcion' => 'max:255',
	];

	protected $listeners = ['render'];

	public function mount()
	{
		$this->unidad = new Unidad;
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$unidades = Auth::user()->propietario->unidades
				/* ->where(function ($query) {
					$query->where('numero', 'LIKE', '%' . $this->busqueda . '%')
						->orWhere('direccion', 'LIKE', '%' . $this->busqueda . '%');
				})
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad) */;
		} else {
			$unidades = [];
		}

		return view('livewire.unidad.tabla-unidad', compact('unidades'));
	}

	public function loadUnidades()
	{
		$this->readyToLoad = true;
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
