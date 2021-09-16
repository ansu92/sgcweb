<?php

namespace App\Http\Livewire\Gasto;

use App\Models\Asamblea;
use App\Models\Gasto;
use App\Models\GastoExtraordinario;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class NuevoGasto extends Component
{
	use WithPagination;

	public $descripcion;
	public $tipo = 'Ordinario';
	public $numeroMeses;
	public Asamblea $asamblea;
	public $calculo;
	public $comienzoCobro;
	public $moneda = 'Bolívar';
	public float $monto = 0.00;
	public $observaciones;
	public Proveedor $proveedor;
	public $factura;

	public $servicios = [];
	public $montos = [];

	public $elegidoAsamblea = 'no';

	public $open = false;

	public $readyToLoad = false;

	public $busqueda;
	public $orden = 'nombre';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $selectAll = false;
	public $selectPage = false;

	protected function rules()
	{
		return [
			'descripcion' => 'required|max:255',
			'tipo' => 'required',
			'numeroMeses' => 'required_if:tipo,Extraordinario',
			'asamblea.id' => 'exclude_if:tipo,Ordinario|required_if:elegidoAsamblea,si',
			'calculo' => 'required|not_in:----',
			'comienzoCobro' => 'required|date|after:last month',
			'moneda' => 'required',
			'monto' => 'required|numeric',
			'observaciones' => 'nullable',
			'proveedor.id' => 'required|not_in:0',
			'factura' => 'required',
			'servicios' => 'exclude_if:proveedor.id,0|min:1',
			'montos.*' => 'exclude_if:servicios.*,false|required_with:servicios.*|numeric|gt:0',
		];
	}

	protected $messages = [
		'comienzoCobro.after' => 'El comienzo de cobro no puede ser un mes anterior al actual.',
		'proveedor.id.required' => 'Debe seleccionar un proveedor.',
		'proveedor.id.not_in' => 'Debe seleccionar un proveedor.',
		'servicios.min' => 'Debe seleccionar al menos un servicio.',
		'montos.*.required_with' => 'El monto es requerido si ha seleccionado el servicio.',
		'montos.*.gt' => 'El monto debe ser mayor que 0.',
	];

	public function mount()
	{
		$this->asamblea = new Asamblea;
		$this->proveedor = new Proveedor;
	}

	public function render()
	{
		$asambleas = Asamblea::all();
		$proveedores = Proveedor::all();

		if ($this->selectAll) {
			$this->servicios = $this->consultaServicios->pluck('id')->map(fn ($id) => (string)$id);
		}

		$listaServicios = $this->readyToLoad ? $this->listaServicios : [];

		return view('livewire.gasto.nuevo-gasto', compact('listaServicios', 'asambleas', 'proveedores'));
	}

	public function getConsultaServiciosProperty()
	{
		return $this->proveedor->servicios()
			->where(function ($query) {
				$query->where('nombre', 'LIKE', '%' . $this->busqueda . '%')
					->orWhere('descripcion', 'LIKE', '%' . $this->busqueda . '%');
			})
			->orderBy($this->orden, $this->direccion);
	}

	public function getListaServiciosProperty()
	{
		return $this->consultaServicios->paginate($this->cantidad);
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad()
	{
		$this->resetPage();
	}

	public function updatingAsamblea($value)
	{
		$this->asamblea = $value == '--' ? new Asamblea : Asamblea::find($value);
	}

	public function updatingProveedor($value)
	{
		$this->proveedor = $value == '----' ? new Proveedor : Proveedor::find($value);
	}

	public function updatedProveedor()
	{
		$this->selectAll = false;
		$this->selectPage = false;

		$this->servicios = [];

		foreach ($this->listaServicios as $servicio) {
			$this->montos[$servicio->id] = '';
		}
	}

	public function updatingServicios()
	{
		$this->reset('monto');
	}

	public function updatedServicios()
	{
		$this->selectAll = false;
		$this->selectPage = false;

		$this->sumarMontos();
	}

	public function updatingMontos()
	{
		$this->reset('monto');
	}

	public function updatedMontos()
	{
		$this->sumarMontos();
	}

	public function updatedSelectPage($value)
	{
		$this->servicios = $value ? $this->deCollectionAArray($this->listaServicios) : [];
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

	private function sumarMontos()
	{
		foreach ($this->montos as $key => $monto) {
			if ($monto != "") {
				if (in_array($key, $this->servicios)) {
					$this->monto = $this->monto + $monto;
				}
			}
		}

		number_format($this->monto, 2, ',', '.');
	}

	private function deCollectionAArray($coleccion)
	{
		foreach ($coleccion as $item) {
			$array[$item->id] = (string)$item->id;
		}

		return $array;
	}

	public function save()
	{
		$this->validate();

		$gasto = Gasto::create([
			'descripcion' => $this->descripcion,
			'tipo' => $this->tipo,
			'calculo_por' => $this->calculo,
			'mes_cobro' => $this->comienzoCobro,
			'moneda' => $this->moneda,
			'monto' => $this->monto,
			'saldo' => $this->monto,
			'observaciones' => $this->observaciones,
			'proveedor_id' => $this->proveedor->id,
			'factura' => $this->factura,
		]);

		if ($this->tipo == 'Extraordinario') {
			$gastoExtraordinario = GastoExtraordinario::create([
				'gasto_id' => $gasto->id,
				'num_meses' => $this->numeroMeses,
			]);

			if ($this->elegidoAsamblea) {
				$gastoExtraordinario->asamblea()->associate($this->asamblea);
				$gastoExtraordinario->save();
			}
		}

		foreach ($this->servicios as $item) {
			$gasto->servicios()->attach($item, ['monto' => $this->montos[$item]]);
		}

		$this->reset([
			'open',
			'descripcion',
			'tipo',
			'numeroMeses',
			'elegidoAsamblea',
			'calculo',
			'comienzoCobro',
			'moneda',
			'monto',
			'observaciones',
			'factura',
			'servicios',
			'montos',
			'selectPage',
			'selectAll',
		]);

		$this->asamblea = new Asamblea;
		$this->proveedor = new Proveedor;

		$this->emitTo('gasto.tabla-gasto', 'render');
		$this->emit('alert', 'El gasto se registró satisfactoriamente');
	}
}
