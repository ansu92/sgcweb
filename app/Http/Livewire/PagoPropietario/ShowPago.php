<?php

namespace App\Http\Livewire\PagoPropietario;

use App\Models\PagoPropietario;
use Livewire\Component;

class ShowPago extends Component
{
	public PagoPropietario $pago;
	
    public function render()
    {
        return view('livewire.pago-propietario.show-pago');
    }
}
