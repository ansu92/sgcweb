<?php

namespace App\Http\Livewire\PagoPropietario;

use App\Models\Fondo;
use App\Models\PagoPropietario;
use App\Models\Recibo;
use App\Traits\WithCurrencies;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ConfirmarPago extends Component
{
	use WithPagination;
	use WithCurrencies;

	public $busqueda;
	public $orden = 'fecha';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openConfirmar = false;
	public $pago;
	public $fondos = [];

	public $openRechazar = false;

	public function render()
	{
		$pagos = $this->readyToLoad ?
			PagoPropietario::where('estado', 'Por confirmar')
			->where('descripcion', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad) :
			[];

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

		toastr()->livewire()->addSuccess('El pago ha sido confirmado satisfactoriamente.');
	}

	public function elegirFondo(PagoPropietario $pago)
	{
		$this->pago = $pago;
		$this->fondos = Fondo::doesntHave('cuenta')->where('moneda', $this->pago->moneda)->get();
		$this->openConfirmar = true;
	}

	public function aceptar(Fondo $fondo)
	{
		$this->pago->fondo()->associate($fondo);
		$this->pago->aceptarPago();

		$ultimoRecibo = Recibo::orderBy('created_at', 'desc')->first();

		$count = $ultimoRecibo ? Str::substr($ultimoRecibo->numero, 12) : 0;

		$numero = 'R' . Str::substr(today(), 0, 4) . Str::substr(today(), 5, 2) . '-' . $this->pago->unidad->numero . '-' . ++$count;

		Recibo::create([
			'numero' => $numero,
			'pago_propietario_id' => $this->pago->id,
		]);

		$this->reset('openConfirmar');

		toastr()->livewire()->addSuccess('El pago ha sido confirmado satisfactoriamente.');
	}

	public function rechazar(PagoPropietario $pago) {
		$pago->rechazar();

		$this->reset('openRechazar');

		toastr()->livewire()->addSuccess('El pago ha sido rechazado');
	}
}
