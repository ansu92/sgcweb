<?php

namespace App\Http\Livewire\TipoUnidad;

use App\Models\TipoUnidad;
use Livewire\Component;
use Livewire\WithPagination;

class TablaTipoUnidad extends Component
{

	use WithPagination;

	public $tipoUnidad;

	public $busqueda;
	public $orden = 'nombre';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'tipoUnidad.nombre' => 'required',
		'tipoUnidad.area' => 'required|numeric',
		'tipoUnidad.descripcion' => 'max:255',
	];

	protected $listeners = ['render'];

	public function mount()
	{
		$this->tipoUnidad = new TipoUnidad;
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$tipoUnidades = TipoUnidad::where('nombre', 'like', '%' . $this->busqueda . '%')
				->orWhere('area', 'like', '%' . $this->busqueda . '%')
				->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$tipoUnidades = [];
		}

		return view('livewire.tipo-unidad.tabla-tipo-unidad', compact('tipoUnidades'));
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

	public function loadTipoUnidades()
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

	public function edit(TipoUnidad $tipoUnidad)
	{
		$this->tipoUnidad = $tipoUnidad;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();
		$this->tipoUnidad->save();
		$this->reset('openEdit');
		$this->emit('alert', 'El tipo de unidad se actualizó satisfactoriamente');
	}

	public function destroy(TipoUnidad $tipoUnidad)
	{
		$this->tipoUnidad = $tipoUnidad;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->tipoUnidad->delete();
		$this->reset('openDestroy');
		$this->emit('alert', 'El tipo de unidad se eliminó satisfactoriamente');
	}
}
