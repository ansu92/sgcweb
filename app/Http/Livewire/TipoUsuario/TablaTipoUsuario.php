<?php

namespace App\Http\Livewire\TipoUsuario;

use App\Models\TipoUsuario;
use Livewire\Component;
use Livewire\WithPagination;

class TablaTipoUsuario extends Component
{

	use WithPagination;

	public $tipoUsuario;

	public $busqueda = '';
	public $orden = 'nombre';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'tipoUsuario.nombre' => 'required|max:25',
		'tipoUsuario.descripcion' => 'max:255',
	];

	protected $listeners = ['render'];

	public function mount()
	{
		$this->tipoUsuario = new TipoUsuario;
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$tipoUsuarios = TipoUsuario::where('nombre', 'like', '%' . $this->busqueda . '%')
				->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$tipoUsuarios = [];
		}
		return view('livewire.tipo-usuario.tabla-tipo-usuario', compact('tipoUsuarios'));
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

	public function loadTipoUsuarios()
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

	public function edit(TipoUsuario $tipoUsuario)
	{
		$this->tipoUsuario = $tipoUsuario;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();
		$this->tipoUsuario->save();
		$this->reset('openEdit');
		$this->emitTo('tabla-tipoUsuario', 'render');
		$this->emit('alert', 'El tipo de usuario se actualizó satisfactoriamente');
	}

	public function destroy(TipoUsuario $tipoUsuario){
		$this->tipoUsuario = $tipoUsuario;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->tipoUsuario->delete();
		$this->reset('openDestroy');
		$this->emitTo('tabla-tipoUsuario', 'render');
		$this->emit('alert', 'El tipo de usuario se eliminó satisfactoriamente');
	}

}
