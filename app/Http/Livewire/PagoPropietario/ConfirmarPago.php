<?php

namespace App\Http\Livewire\PagoPropietario;

use App\Models\Fondo;
use App\Models\PagoPropietario;
use App\Models\Recibo;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use NumberFormatter;

class ConfirmarPago extends Component
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

	public $openConfirmar = false;
	public $pago;
	public $fondos = [];

	public function render()
	{
		$this->formatoDinero = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);

		$pagos = $this->readyToLoad ?
			PagoPropietario::where('estado', 'Por confirmar')
			->where('descripcion', 'LIKE', '%' . $this->busqueda . '%')
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

		return view('livewire.pago-propietario.confirmar-pago', compact('pagos'));
	}

	public function confirmar(PagoPropietario $pago)
	{
		$pago->pagarFactura();

		$ultimoRecibo = Recibo::orderBy('created_at', 'desc')->first();

		$count = $ultimoRecibo ? Str::substr($ultimoRecibo->numero, 12) : 0;

		$numero = 'R' . Str::substr(today(), 0, 4) . Str::substr(today(), 5, 2) . '-' . $pago->unidad->numero . '-' . ++$count;

		Recibo::create([
			'numero' => $numero,
			'pago_propietario_id' => $pago->id,
		]);

		$this->emit('alert', 'El pago ha sido confirmado satisfactoriamente.');
	}

	public function elegirFondo(PagoPropietario $pago)
	{
		$this->pago = $pago;
		$this->fondos = Fondo::doesntHave('cuenta')->where('moneda', $this->pago->moneda)->get();
		$this->openConfirmar = true;
	}

	public function aceptar(Fondo $fondo)
	{
		$this->pago->aceptarPago($fondo);

		$ultimoRecibo = Recibo::orderBy('created_at', 'desc')->first();

		$count = $ultimoRecibo ? Str::substr($ultimoRecibo->numero, 12) : 0;

		$numero = 'R' . Str::substr(today(), 0, 4) . Str::substr(today(), 5, 2) . '-' . $this->pago->unidad->numero . '-' . ++$count;

		Recibo::create([
			'numero' => $numero,
			'pago_propietario_id' => $this->pago->id,
		]);

		$this->reset('openConfirmar');

		$this->emit('alert', 'El pago ha sido confirmado satisfactoriamente.');
	}
}
