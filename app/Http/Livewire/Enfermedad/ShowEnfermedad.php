<?php

namespace App\Http\Livewire\Enfermedad;

use App\Models\Enfermedad;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEnfermedad extends Component
{
	use WithPagination;

	public Enfermedad $enfermedad;
	
    public function render()
    {
        return view('livewire.enfermedad.show-enfermedad');
    }
}
