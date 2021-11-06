<?php

namespace App\Http\Livewire\PagoPropietario;

use App\Models\PagoPropietario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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

		$pagos = new Collection;

		$unidades = Auth::user()->propietario->unidades;

		if ($this->readyToLoad) {

			foreach ($unidades as $item) {

				foreach ($item->pagos as $pago) {
					$pagos->push($pago);
				}
			}
			$pagos = $pagos->toQuery()
				->where('descripcion', 'LIKE', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$pagos = new Collection;
		}

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
