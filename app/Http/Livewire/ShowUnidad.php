<?php

namespace App\Http\Livewire;

use App\Models\Unidad;
use Livewire\Component;

class ShowUnidad extends Component
{
	public $unidad;

	public $busqueda = '';
	public $orden = 'nombre';
	public $direccion = "asc";
	
    public function render()
    {
        return view('livewire.show-unidad');
    }
}
