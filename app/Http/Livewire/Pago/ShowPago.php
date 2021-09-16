<?php

namespace App\Http\Livewire\Pago;

use App\Models\Pago;
use Livewire\Component;

class ShowPago extends Component
{
	public Pago $pagoCondominio;
	
    public function render()
    {
        return view('livewire.pago.show-pago');
    }
}
