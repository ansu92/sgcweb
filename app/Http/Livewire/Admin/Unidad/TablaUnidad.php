<?php

namespace App\Http\Livewire\Admin\Unidad;

use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class TablaUnidad extends Component
{
	use WithPagination;

	public $unidad;

	public $busqueda;
	public $orden = 'numero';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'categoria.nombre' => 'required|max:25',
		'categoria.descripcion' => 'max:255',
	];

	protected $listeners = ['render'];

	public function mount()
	{
		$this->unidad = new Unidad;
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$unidades = Unidad::where('numero', 'LIKE', '%'.$this->busqueda.'%')
				->orWhere('direccion', 'LIKE', '%'.$this->busqueda.'%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$unidades = [];
		}

		return view('livewire.admin.unidad.tabla-unidad', compact('unidades'));
	}

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad()
	{
		$this->resetPage();
	}

	public function loadUnidades()
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

	public function edit(Unidad $unidad)
	{
		$this->unidad = $unidad;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->unidad->save();

		$this->reset('openEdit');

		$this->emit('alert', 'La unidad se actualizó satisfactoriamente');
	}

	public function destroy(Unidad $unidad)
	{
		$this->unidad = $unidad;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->unidad->delete();

		$this->reset('openDestroy');

		$this->emit('alert', 'La unidad se eliminó satisfactoriamente');
	}
}
