<?php

namespace App\Http\Livewire\Gasto;

use App\Models\Asamblea;
use App\Models\Gasto;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class NuevoGasto extends Component
{
	use WithPagination;
	
	public $descripcion, $monto, $fecha, $factura, $observaciones, $servicios = [];

	public $readyToLoad = false;

	public $busqueda;
	public $orden = 'nombre';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $open = false;

	protected $rules = [
		'descripcion' => 'required|max:255',
		'monto' => 'required|numeric',
		'fecha' => 'required',
		'observaciones' => 'nullable',
		'servicios' => 'nullable',
	];

	public function render()
	{
		$asambleas = Asamblea::all();
		
		if ($this->readyToLoad) {
			$listaServicios = Servicio::where('nombre', 'LIKE', '%' . $this->busqueda . '%')
				->orWhere('descripcion', 'LIKE', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$listaServicios = [];
		}

		return view('livewire.gasto.nuevo-gasto', compact('listaServicios', 'asambleas'));
	}

	// public function loadServicios()
	// {
	// 	$this->readyToLoad = true;
	// }

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

		$gasto = Gasto::create([
			'descripcion' => $this->descripcion,
			'monto' => $this->monto,
			'fecha' => $this->fecha,
			'observaciones' => $this->observaciones,
		]);

		$gasto->servicios()->attach($$this->servicios);

		$this->reset([
			'open',
			'descripcion',
			'monto',
			'fecha',
			'observaciones',
			'servicios',
		]);

		$this->emitTo('gasto.tabla-gasto', 'render');
		$this->emit('alert', 'El gasto se registró satisfactoriamente');
	}
}
