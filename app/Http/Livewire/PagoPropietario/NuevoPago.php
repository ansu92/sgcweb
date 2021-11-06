<?php

namespace App\Http\Livewire\PagoPropietario;

use App\Models\Factura;
use App\Models\Cuenta;
use App\Models\PagoPropietario;
use App\Models\TasaCambio;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use NumberFormatter;

class NuevoPago extends Component
{
	use WithPagination;

	public $descripcion;
	public $monto;
	public $montoFormateado;
	public $fecha;
	public $referencia;
	public $formaPago;
	public $moneda = 'Bolívar';
	public $tasaCambio;

	public Factura $factura;
	public Cuenta $cuenta;

	public bool $conCambio = false;
	public $montoFacturaConvertido;
	public $montoFacturaConvertidoFormateado;

	private NumberFormatter $formatoDinero;
	private $bolivar = 'VES';
	private $dolar = 'USD';

	public $open = false;

	public $busqueda;
	public $orden = 'fecha';
	public $direccion = 'desc';
	public $cantidad = '10';

	protected function rules()
	{
		$rules = [
			'descripcion' => 'required',
			'fecha' => 'required|before_or_equal:today',
			'formaPago' => 'required',
			'moneda' => 'required',
			'cuenta.id' => 'required|not_in:0',
			'referencia' => 'exclude_unless:formaPago,Transferencia,Pago móvil|min:4|max:8',
			'tasaCambio.tasa' => 'exclude_if:conCambio,false|required|numeric',
		];

		if ($this->conCambio == true) {
			if ($this->tasaCambio) {
				$rules['monto'] = [
					'required',
					'numeric',
					'gt:0',
					'lte:' . $this->montoFacturaConvertido,
				];
			} else {
				$rules['monto'] = 'required|numeric';
			}
		} else {
			$rules['monto'] = [
				'required',
				'numeric',
				'lte:factura.monto_por_pagar',
			];
		}

		return $rules;
	}

	protected $messages = [
		'cuenta.id.required' => 'Debe seleccionar una cuenta.',
		'cuenta.id.not_in' => 'Debe seleccionar una cuenta.',
		'monto.lte' => 'El monto no debe ser mayor al total de la deuda.',
		'tasaCambio.tasa.required_if' => 'Debe ingresar la tasa de cambio.'
	];

	public function mount()
	{
		$this->factura = new Factura;
		$this->cuenta = new Cuenta;
		$this->tasaCambio = TasaCambio::orderBy('created_at', 'desc')->first();

		$this->conCambio = $this->moneda != $this->factura->moneda;

		$this->formatoDinero = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);
	}

	public function render()
	{
		$facturas = Auth::user()->propietario->facturas()
			->where('estado', 'Pendiente')
			->paginate($this->cantidad);

		if ($this->formaPago == 'Pago móvil') {
			$cuentas = Cuenta::where('publica', true)->get();
		} else {
			$cuentas = Cuenta::where('publica', true)
				->whereNotNull('telefono')
				->get();
		}

		foreach ($cuentas as $item) {
			$item->ocultarNumero();
		}

		return view('livewire.pago-propietario.nuevo-pago', compact('facturas', 'cuentas'));
	}

	public function mostrarForm(Factura $factura)
	{
		$this->reset([
			'descripcion',
			'monto',
			'fecha',
			'referencia',
			'formaPago',
			'moneda',
		]);

		$this->factura = $factura;
		$this->moneda = $this->factura->moneda;
		$this->conCambio = $this->moneda != $this->factura->moneda;

		$this->formatoDinero = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);

		if ($this->factura->moneda == 'Bolívar') {
			$this->montoFormateado = $this->formatoDinero->format($this->factura->monto_por_pagar);
		} elseif ($this->factura->moneda == 'Dólar') {
			$this->montoFormateado = $this->formatoDinero->formatCurrency($this->factura->monto_por_pagar, $this->dolar);
		}

		$this->open = true;
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedFormaPago($value)
	{
		$this->formaPago = $value == '----' ? null : $value;
		$this->validateOnly('formaPago');

		$this->cuenta = new Cuenta;
		$this->cuenta->id = 0;
	}

	public function updatedMoneda()
	{
		$this->cuenta = new Cuenta;

		$this->conCambio = $this->moneda != $this->factura->moneda;

		$this->validarMonto();
	}

	public function updatingCuenta($value)
	{
		if ($value == 0) {
			$this->cuenta = new Cuenta;
		} else {

			$this->cuenta = Cuenta::find($value);
		};
	}

	public function updatedTasaCambio()
	{
		$this->convertirMonto();
		$this->validarMonto();
	}

	private function validarMonto()
	{
		if ($this->conCambio) {
			if ($this->tasaCambio) {
				$this->convertirMonto();

				$rules['monto'] = [
					'exclude_if:monto,null',
					'required',
					'numeric',
					'gt:0',
					'lte:' . $this->montoFacturaConvertido,
				];

				$this->validateOnly('monto', $rules);
			} else {
				$this->validateOnly('monto', ['monto' => '']);
			}
		} else {
			$rules['monto'] = [
				'exclude_if:monto,null',
				'required',
				'numeric',
				'gt:0',
				'lte:factura.monto_por_pagar',
			];

			$this->validateOnly('monto', $rules);
		}
	}

	private function convertirMonto()
	{
		$this->formatoDinero = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);

		if ($this->moneda == 'Bolívar') {
			$this->montoFacturaConvertido = $this->factura->monto_por_pagar * $this->tasaCambio->tasa;
			$this->montoFacturaConvertidoFormateado = $this->formatoDinero->formatCurrency($this->montoFacturaConvertido, 'VES');
		} else if ($this->moneda == 'Dólar') {
			$this->montoFacturaConvertido = $this->factura->monto_por_pagar / $this->tasaCambio->tasa;
			$this->montoFacturaConvertidoFormateado = $this->formatoDinero->formatCurrency($this->montoFacturaConvertido, 'USD');
		}
	}

	public function pagarTotal()
	{
		if ($this->conCambio) {
			if ($this->tasaCambio) {
				if ($this->moneda == 'Bolívar') {

					$this->monto = $this->montoFacturaConvertido;
					// $this->monto = '1';
				} elseif ($this->moneda == 'Dólar') {

					$this->monto = $this->montoFacturaConvertido;
					// $this->monto = '2';
				}
			} else {
				$this->validateOnly('tasaCambio.tasa');
			}
		} else {

			$this->monto = $this->factura->monto_por_pagar;
			// $this->monto = '3';
		}

		$this->validateOnly('monto');
	}

	public function save()
	{
		$this->validate();

		$pago = PagoPropietario::create([
			'descripcion' => $this->descripcion,
			'monto' => $this->monto,
			'fecha' => $this->fecha,
			'referencia' => $this->referencia,
			'forma_pago' => $this->formaPago,
			'moneda' => $this->moneda,
			'tasa_cambio_id' => $this->tasaCambio->id,
			'cuenta_id' => $this->cuenta->id,
			'unidad_id' => $this->factura->unidad->id,
			'factura_id' => $this->factura->id
		]);

		$pago->save();

		// $pago->pagarFactura($this->conCambio);

		$this->reset([
			'open',
			'descripcion',
			'monto',
			'fecha',
			'referencia',
			'formaPago',
			'moneda',
		]);

		$this->factura = new Factura;
		$this->cuenta = new Cuenta;

		$this->emit('alert', 'El pago ha sido registrado, debe esperar que el condominio confirme el pago para ver los cambios.');
	}
}
