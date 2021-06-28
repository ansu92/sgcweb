<?php

namespace App\Http\Livewire;

use App\Models\TipoUnidad;
use Livewire\Component;

class ShowTipoUnidad extends Component
{
    public TipoUnidad $tipoUnidad;

    public function render()
    {
        return view('livewire.show-tipo-unidad');
    }
}
