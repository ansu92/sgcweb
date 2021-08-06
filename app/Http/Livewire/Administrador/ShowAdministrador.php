<?php

namespace App\Http\Livewire\Administrador;

use App\Models\Administrador;
use Livewire\Component;

class ShowAdministrador extends Component
{
	public Administrador $administrador;
	
    public function render()
    {
        return view('livewire.administrador.show-administrador');
    }
}
