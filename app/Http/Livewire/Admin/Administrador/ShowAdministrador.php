<?php

namespace App\Http\Livewire\Admin\Administrador;

use App\Models\Administrador;
use Livewire\Component;

class ShowAdministrador extends Component
{
	public Administrador $administrador;
	
    public function render()
    {
        return view('livewire.admin.administrador.show-administrador');
    }
}
