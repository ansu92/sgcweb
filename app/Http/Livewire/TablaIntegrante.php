<?php

namespace App\Http\Livewire;

use App\Models\Integrante;
use Livewire\Component;
use Livewire\WithPagination;

class TablaIntegrante extends Component
{
	use WithPagination;
	
	public $integrante;

	public $busqueda = '';
	public $orden = 'nombre';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'integrante.nombre' => 'required|max:25',
		'integrante.descripcion' => 'max:255',
	];

	protected $listeners = ['render'];

	public function mount()
	{
		$this->integrante = new Integrante;
	}

    public function render()
    {
		if ($this->readyToLoad) {
			$integrantes = Integrante::where('documento', 'like', '%' . $this->busqueda . '%')
				->orWhere('nombre', 'like', '%' . $this->busqueda . '%')
				->orWhere('apellido', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$integrantes = [];
		}

        return view('livewire.tabla-integrante', compact('integrantes'));
    }

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad() {
		$this->resetPage();
	}

	public function loadIntegrantes()
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

	public function edit(Integrante $integrante)
	{
		$this->integrante = $integrante;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->integrante->save();

		$this->reset('openEdit');

		$this->emit('alert', 'La persona se actualizó satisfactoriamente');
	}

	public function destroy(Integrante $integrante) {
		$this->integrante = $integrante;
		$this->openDestroy = true;
	}

	public function delete() {
		$this->integrante->delete();

		$this->reset('openDestroy');

		$this->emit('alert', 'La persona se eliminó satisfactoriamente');
	}
}
