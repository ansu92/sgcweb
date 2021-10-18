<?php

namespace App\Http\Livewire\Medicamento;

use App\Models\Medicamento;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMedicamento extends Component
{
	use WithPagination;

	public Medicamento $medicamento;
	
    public function render()
    {
        return view('livewire.medicamento.show-medicamento');
    }
}
