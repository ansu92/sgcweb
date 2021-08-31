<?php

namespace App\Http\Livewire\Admin\Comunicado;

use App\Models\Comunicado;
use Livewire\Component;

class ShowComunicado extends Component
{
	public Comunicado $comunicado;
	
    public function render()
    {
        return view('livewire.admin.comunicado.show-comunicado');
    }
}
