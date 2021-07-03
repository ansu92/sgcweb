<?php

namespace App\Http\Livewire\Gasto;

use Livewire\Component;

class TablaGasto extends Component
{
	public $cantidad = '10';

    public function render()
    {
        return view('livewire.gasto.tabla-gasto');
    }
}
