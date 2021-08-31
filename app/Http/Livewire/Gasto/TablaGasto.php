<?php

namespace App\Http\Livewire\Gasto;

use App\Models\Gasto;
use Livewire\Component;
use Livewire\WithPagination;

class TablaGasto extends Component
{
	use WithPagination;

	public $busqueda;
	public $orden = 'created_at';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	protected $listeners = ['render'];

    public function render()
    {
		$gastos = $this->readyToLoad ?
			Gasto::where('descripcion', 'LIKE', '%'.$this->busqueda.'%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad) :
			[];

        return view('livewire.gasto.tabla-gasto', compact('gastos'));
    }
}
