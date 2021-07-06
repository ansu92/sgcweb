<?php

namespace App\Http\Livewire\TipoUsuario;

use App\Models\TipoUsuario;
use Livewire\Component;

class ShowTipoUsuario extends Component
{

    public TipoUsuario $tipoUsuario;

    public function render()
    {
        return view('livewire.tipo-usuario.show-tipo-usuario');
    }
}
