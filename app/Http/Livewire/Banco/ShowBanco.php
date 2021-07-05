<?php

namespace App\Http\Livewire\Banco;

use App\Models\Banco;
use Livewire\Component;

class ShowBanco extends Component
{

    public Banco $banco;

    public function render()
    {
        return view('livewire.banco.show-banco');
    }
}
