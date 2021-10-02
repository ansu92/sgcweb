<?php

namespace App\Http\Livewire\PagoPropietario;

use App\Models\PagoPropietario;
use Livewire\Component;
use Livewire\WithPagination;
use NumberFormatter;

class TablaPago extends Component
{
	use WithPagination;

	private NumberFormatter $formatoDinero;
	private $bolivar = 'VES';
	private $dolar = 'USD';

	public $busqueda;
	public $orden = 'fecha';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public function render()
	{
		$this->formatoDinero = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);

		$pagos = $this->readyToLoad ?
			PagoPropietario::where('descripcion', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad) :
			[];

		foreach ($pagos as $pago) {

			if ($pago->moneda == 'Bolívar') {

				$pago->montoFormateado = $this->formatoDinero->format($pago->monto);
			} else if ($pago->moneda == 'Dólar') {

				$pago->montoFormateado = $this->formatoDinero->formatCurrency($pago->monto, $this->dolar);
			}
		}

        return view('livewire.pago-propietario.tabla-pago', compact('pagos'));
    }
}
