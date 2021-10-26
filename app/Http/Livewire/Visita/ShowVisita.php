<?php

namespace App\Http\Livewire\Visita;

use App\Models\Visita;
use Livewire\Component;

class ShowVisita extends Component
{
    public Visita $visita;

    public function render()
    {
        return view('livewire.visita.show-visita');
    }
}
