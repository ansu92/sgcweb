<?php

namespace App\Http\Livewire\Pago;

use App\Models\Fondo;
use App\Models\Gasto;
use App\Models\Pago;
use Livewire\Component;
use Livewire\WithPagination;
use NumberFormatter;

class NuevoPago extends Component
{
	use WithPagination;

	public $descripcion;
	public $monto;
	public $fecha;
	public $recibo;
	public $referencia;
	public $formaPago = '----';
	public $moneda = 'Bolívar';
	public $tasaCambio;

	public Gasto $gasto;
	public Fondo $fondo;

	public $conCambio;
	public $montoConvertido;

	public $open = false;

	public $busqueda;
	public $orden = 'created_at';
	public $direccion = 'desc';
	public $cantidad = '10';

	protected $rules = [
		'gasto.descripcion' => 'required',
		'gasto.saldo' => 'required',
		'descripcion' => 'required',
		'fecha' => 'required|before_or_equal:today',
		'recibo' => 'required|numeric',
		'formaPago' => 'required|not_in:----',
		'moneda' => 'required',
		'fondo.id' => 'required',
		'monto' => 'required|numeric|lte:gasto.saldo',
		'referencia' => 'required_if:formaPago,Transferencia,Pago móvil',
		'tasaCambio' => 'required_if:conCambio,true',
	];

	public function mount()
	{
		$this->gasto = new Gasto;
		$this->fondo = new Fondo;
	}

	public function render()
	{
		$gastos = Gasto::where('estado', 'Pendiente')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

		$fondos = Fondo::where('moneda', $this->moneda)->get();

		return view('livewire.pago.nuevo-pago', compact('gastos', 'fondos'));
	}

	public function mostrarForm(Gasto $gasto)
	{
		$this->gasto = $gasto;

		$this->open = true;
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedMoneda()
	{
		$this->conCambio = $this->moneda != $this->gasto->moneda;
	}

	public function updatingFondo($value)
	{
		$this->fondo = $value == '----' ? new Fondo : Fondo::find($value);
	}

	public function updatedTasaCambio() {
		$this->convertirMonto();
	}

	private function convertirMonto() {
		if ($this->moneda == 'Bolívar') {
			$this->montoConvertido = $this->gasto->saldo * $this->tasaCambio;
		} else if ($this->moneda == 'Dólar') {
			$this->montoConvertido = $this->gasto->saldo / $this->tasaCambio;
		}

		$formatter = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);
		$this->montoConvertido = $formatter->format($this->montoConvertido);
	}

	public function save()
	{
		$this->validate();

		$pago = Pago::create([
			'descripcion' => $this->descripcion,
			'monto' => $this->monto,
			'fecha' => $this->fecha,
			'recibo' => $this->recibo,
			'referencia' => $this->referencia,
			'forma_pago' => $this->formaPago,
			'moneda' => $this->moneda,
			'tasa_cambio' => $this->tasaCambio,
		]);

		$pago->gasto()->associate($this->gasto);
		$pago->fondo()->associate($this->fondo);

		$pago->save();

		$pago->pagarGasto();

		$this->reset([
			'open',
			'descripcion',
			'monto',
			'fecha',
			'recibo',
			'referencia',
			'formaPago',
			'moneda',
			'tasaCambio',
		]);

		$this->gasto = new Gasto;
		$this->fondo = new Fondo;

		$this->emit('alert', 'El pago se ha realizado satisfactoriamente');
	}
}
