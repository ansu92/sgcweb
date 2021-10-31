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
	public $subConInteres = 0;
	public $montoIva = 0;
	public $montoInteres = 0;
	public $total = 0;

	public function mount()
	{
		$this->iva = Iva::orderBy('created_at', 'desc')->first();

		foreach ($this->factura->items as $item) {
			$item->montoSinIva = $this->revertirIva($item->monto);

			$this->sub += $item->montoSinIva;
		}

		if ($this->factura->interes) {
			$this->montoInteres = $this->sub * ($this->factura->interes->factor / 100);

			// $this->subConInteres = $this->sub + $this->montoInteres;
			$this->subConInteres = $this->factura->monto;

			$this->montoIva = $this->subConInteres * ($this->factura->iva->factor / 100);

			$this->total = $this->subConInteres + $this->montoIva;
		} else {

			$this->montoIva = $this->sub * ($this->factura->iva->factor / 100);

			$this->total = $this->sub + $this->montoIva;
		}
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
