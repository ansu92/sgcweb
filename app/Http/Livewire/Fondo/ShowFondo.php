<?php

namespace App\Http\Livewire\Fondo;

use App\Models\Fondo;
use Livewire\Component;

class ShowFondo extends Component
{
    public Fondo $fondo;

    protected $listeners = ['render'];

    // public function mount()
    // {
    //     if ($this->fondo->cuenta) {

    //         $this->fondo->cuenta->ocultarNumero();
    //     }
    // }

    public function render()
    {
        return view('livewire.fondo.show-fondo');
    }
}
