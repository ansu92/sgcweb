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
	public $subSinIva = 0;
	public $montoIva = 0;
	public $total = 0;

	public function mount()
	{
		$this->iva = Iva::orderBy('created_at', 'desc')->first();

		foreach ($this->factura->items as $item) {
			$item->montoSinIva = $this->revertirIva($item->monto);

			$this->subSinIva += $item->montoSinIva;

			$this->total += $item->monto;
		}

		$this->montoIva = $this->subSinIva * ($this->factura->iva->factor / 100);

		$this->total = $this->subSinIva + $this->montoIva;
	}

	public function render()
	{
		$condominio = Condominio::first();

		return view('livewire.show-factura', compact('condominio'));
	}

	private function revertirIva($monto)
	{
		$montoSinIva = $monto / (($this->iva->factor / 100) + 1);
		return $montoSinIva;
	}
}
