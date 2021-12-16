<?php

namespace App\Http\Livewire\PagoPropietario;

use App\Models\Factura;
use App\Models\Cuenta;
use App\Models\PagoPropietario;
use App\Models\TasaCambio;
use App\Traits\WithCurrencies;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class NuevoPago extends Component
{
	use WithPagination;
	use WithCurrencies;

	public $descripcion;
	public $monto;
	public $montoFormateado;
	public $fecha;
	public $referencia;
	public $formaPago;
	public $moneda;

	public Factura $factura;
	public Cuenta $cuenta;

	public bool $conCambio = false;
	public $montoFacturaConvertido;
	public $montoFacturaConvertidoFormateado;

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
			'cuenta.id' => 'exclude_unless:formaPago,Transferencia,Pago móvil,Punto de venta,Depósito|not_in:0',
			'referencia' => 'exclude_unless:formaPago,Transferencia,Pago móvil|required|min:4|max:8',
		];

		if ($this->conCambio == true) {
			$rules['monto'] = [
				'required',
				'numeric',
				'gt:0',
				'lte:' . $this->montoFacturaConvertido,
			];
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
		'fecha.before_or_equal' => 'La fecha debe ser anterior o igual al día actual.',
		'cuenta.id.required' => 'Debe seleccionar una cuenta.',
		'cuenta.id.not_in' => 'Debe seleccionar una cuenta.',
		'monto.lte' => 'El monto no debe ser mayor al total de la deuda.',
	];

	public function mount()
	{
		$this->factura = new Factura;
		$this->cuenta = new Cuenta;
	}

	public function render()
	{
		$facturas = Auth::user()->propietario->facturas()
			->where('estado', 'Pendiente')
			->paginate($this->cantidad);

		if ($this->formaPago == 'Pago móvil') {
			$cuentas = Cuenta::where('publica', true)->whereNotNull('telefono')->get();
			
		} else {
			$cuentas = Cuenta::where('publica', true)->get();
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

		$this->montoFormateado = $this->factura->montoPorPagarFormateado;

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

	private function validarMonto()
	{
		if ($this->conCambio) {
			$this->montoFacturaConvertido = $this->convertirMonto($this->factura->monto_por_pagar, $this->moneda, $this->tasaCambio->tasa);
			$this->montoFacturaConvertido = number_format($this->montoFacturaConvertido, 2);
			$this->montoFacturaConvertidoFormateado = $this->FormatearMonto($this->montoFacturaConvertido, $this->moneda);

			$rules['monto'] = [
				'exclude_if:monto,null',
				'required',
				'numeric',
				'gt:0',
				'lte:' . $this->montoFacturaConvertido,
			];

			$this->validateOnly('monto', $rules);
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

	public function orden($orden)
	{
		if ($this->orden == $orden) {
			if ($this->direccion == 'desc') {
				$this->direccion = 'asc';
			} else {
				$this->direccion = 'desc';
			}
		} else {
			$this->orden = $orden;
			$this->direccion = 'asc';
		}
	}

	public function save()
	{
		$this->validate();

		$datos = [
			'descripcion' => $this->descripcion,
			'monto' => $this->monto,
			'fecha' => $this->fecha,
			'referencia' => $this->referencia,
			'forma_pago' => $this->formaPago,
			'moneda' => $this->moneda,
			'tasa_cambio_id' => $this->tasaCambio->id,
			'unidad_id' => $this->factura->unidad->id,
			'factura_id' => $this->factura->id
		];

		if ($this->formaPago == 'Transferencia' || $this->formaPago == 'Pago móvil') {
			$datos['fondo_id'] = $this->cuenta->fondo->id;
		}

		$pago = PagoPropietario::create($datos);

		// $pago->save();

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

		toastr()->livewire()->addSuccess('El pago ha sido registrado, debe esperar que el condominio confirme el pago para ver los cambios.');
	}

	public function getTasaCambioProperty() {
		return TasaCambio::orderBy('created_at', 'desc')->first();
	}
}
