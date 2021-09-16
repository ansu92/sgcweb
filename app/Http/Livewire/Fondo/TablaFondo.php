<?php

namespace App\Http\Livewire\Fondo;

use App\Models\Fondo;
use Livewire\Component;
use Livewire\WithPagination;
use NumberFormatter;

class TablaFondo extends Component
{
	use WithPagination;

	public Fondo $fondo;

	public $busqueda = '';
	public $orden = 'descripcion';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'fondo.descripcion' => 'required|max:255',
		'fondo.moneda' => 'required'
	];

	protected $listeners = ['render'];

	public function render()
	{
		if ($this->readyToLoad) {
			$fondos = Fondo::where('descripcion', 'like', '%' . $this->busqueda . '%')
				->orWhere('moneda', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);

				foreach ($fondos as $fondo) {
					$fondo->saldoFormateado = $this->formatearMonto($fondo->saldo, $fondo->moneda);
				}
		} else {
			$fondos = [];
		}

		return view('livewire.fondo.tabla-fondo', compact('fondos'));
	}

	private function formatearMonto($monto, $moneda)
	{
		$formatoDinero = new NumberFormatter('es_VE', NumberFormatter::CURRENCY);
		$bolivar = 'VES';
		$dolar = 'USD';

		if ($moneda == 'Bolívar') {
			$montoFormateado = $formatoDinero->formatCurrency($monto, $bolivar);
		} else if ($moneda == 'Dólar') {
			$montoFormateado = $formatoDinero->formatCurrency($monto, $dolar);
		}

		return $montoFormateado;
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

	public function loadFondos()
	{
		$this->readyToLoad = true;
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
}
