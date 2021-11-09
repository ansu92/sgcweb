<?php

namespace App\Http\Livewire\Asamblea;

use App\Models\Asamblea;
use App\Models\Integrante;
use Livewire\Component;
use Livewire\WithPagination;

class NuevaAsamblea extends Component
{
	use WithPagination;

	public $descripcion, $fecha, $observacion;
	public $asistentes = [];

	public $abierto = false;

	public $selectAll = false;
	public $selectPage = false;

	public $busqueda = '';
	public $orden = 'documento';
	public $direccion = 'desc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public $rules = [
		'descripcion' => 'required',
		'fecha' => 'required',
		'observacion' => 'nullable',
		'asistentes' => 'required',
	];

	public function getConsultaIntegrantesProperty()
	{
		return Integrante::has('unidad')
			->where(function ($query) {
				$query->where('documento', 'like', '%' . $this->busqueda . '%')
					->orwhere('nombre', 'like', '%' . $this->busqueda . '%')
					->orwhere('apellido', 'like', '%' . $this->busqueda . '%');
			})
			->orderBy($this->orden, $this->direccion);
	}

	public function getIntegrantesProperty()
	{
		return $this->consultaIntegrantes->paginate($this->cantidad);
	}

	public function render()
	{

		if ($this->selectAll) {
			$this->asistentes = $this->consultaIntegrantes->pluck('id')->map(fn ($id) => (string)$id);
		}

		$integrantes = $this->readyToLoad ? $this->integrantes : [];

		return view('livewire.asamblea.nueva-asamblea', compact('integrantes'));
	}

	public function loadIntegrantes()
	{
		$this->readyToLoad = true;
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

	public function updatedAsistentes()
	{
		$this->selectAll = false;
		$this->selectPage = false;
	}

	public function updatedSelectPage($value)
	{
		$this->asistentes = $value ? $this->integrantes->pluck('id')->map(fn ($id) => (string)$id) : [];
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

	function save()
	{
		$this->validate();

		$asamblea = Asamblea::create([
			'descripcion' => $this->descripcion,
			'fecha' => $this->fecha,
			'observaciones' => $this->observacion,
		]);

		$asamblea->asistentes()->attach($this->asistentes);

		$this->reset([
			'abierto',
			'descripcion',
			'fecha',
			'observacion',
			'asistentes',
		]);

		$this->emitTo('asamblea.tabla-asamblea', 'render');
		$this->emit('alert', 'La asamblea se registró satisfactoriamente');
	}
}
