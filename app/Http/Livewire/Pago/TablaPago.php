<?php

namespace App\Http\Livewire\Pago;

use App\Models\Pago;
use Livewire\Component;
use Livewire\WithPagination;

class TablaPago extends Component
{
	use WithPagination;
	
	public $busqueda;
	public $orden = 'fecha';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public function render()
	{
		$pagos = $this->readyToLoad ?
			Pago::where('descripcion', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad) :
			[];

		return view('livewire.pago.tabla-pago', compact('pagos'));
	}
}
