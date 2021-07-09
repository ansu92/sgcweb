<?php

namespace App\Http\Livewire\Gasto;

use App\Models\Gasto;
use Livewire\Component;

class TablaGasto extends Component
{
	public $busqueda;
	public $orden = 'id';
	public $direccion = 'desc';
	public $cantidad = '10';

	public $readyToLoad = false;

	protected $listeners = ['render'];

    public function render()
    {
		$gastos = $this->readyToLoad ? Gasto::all() : [];

        return view('livewire.gasto.tabla-gasto', compact('gastos'));
    }
}
