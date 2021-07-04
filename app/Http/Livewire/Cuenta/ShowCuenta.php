<?php

namespace App\Http\Livewire\Cuenta;

use App\Models\Cuenta;
use Livewire\Component;

class ShowCuenta extends Component
{

    public Cuenta $cuenta;

    public function render()
    {
        return view('livewire.cuenta.show-cuenta');
    }
}
