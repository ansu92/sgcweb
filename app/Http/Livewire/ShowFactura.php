<?php

namespace App\Http\Livewire;

use App\Models\Condominio;
use App\Models\Factura;
use Livewire\Component;

class ShowFactura extends Component
{
    public Factura $factura;

    public function render()
    {
        $condominio = Condominio::first();

        return view('livewire.show-factura', compact('condominio'));
    }
}
