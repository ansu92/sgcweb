<?php

namespace App\Http\Livewire;

use App\Models\Condominio;
use App\Models\Factura;
use App\Models\Iva;
use Livewire\Component;

class ShowFactura extends Component
{
    public Factura $factura;
	public $countItems = 0;
	public $sub = 0;
	public Iva $iva;
	public $total = 0;

	public function mount() {
		$this->iva = Iva::orderBy('created_at', 'desc')->first();
	}

    public function render()
    {
        $condominio = Condominio::first();

        return view('livewire.show-factura', compact('condominio'));
    }

	private function revertirIva() {
		$monto = $this->total/($this->iva->factor + 1);
		return $monto;
	}
}
