<?php

namespace App\Http\Livewire;

use App\Models\Integrante;
use Livewire\Component;

class ShowIntegrante extends Component
{
	public Integrante $integrante;
	
    public function render()
    {
        return view('livewire.show-integrante');
    }
}
