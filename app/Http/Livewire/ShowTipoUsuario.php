<?php

namespace App\Http\Livewire;

use App\Models\TipoUsuario;
use Livewire\Component;

class ShowTipoUsuario extends Component
{

    public TipoUsuario $tipoUsuario;

    public function render()
    {
        return view('livewire.show-tipo-usuario');
    }
}
