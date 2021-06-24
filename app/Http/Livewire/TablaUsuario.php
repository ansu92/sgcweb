<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TablaUsuario extends Component
{
	use WithPagination;
	
	public $usuario;

	public $busqueda = '';
	public $orden = 'name';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openDestroy = false;

	protected $rules = [
		'usuario.name' => 'required|max:25',
		'usuario.descripcion' => 'max:255',
	];

	protected $listeners = ['render'];

	public function mount()
	{
		$this->usuario = new User;
	}

    public function render()
    {
		if ($this->readyToLoad) {
			$usuarios = User::where('name', 'like', '%' . $this->busqueda . '%')
				->orWhere('email', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$usuarios = [];
		}

        return view('livewire.tabla-usuario', compact('usuarios'));
    }

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad() {
		$this->resetPage();
	}

	public function loadUsuarios()
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

	public function destroy(User $usuario) {
		$this->usuario = $usuario;
		$this->openDestroy = true;
	}

	public function delete() {
		$this->usuario->delete();

		$this->reset('openDestroy');

		$this->emit('alert', 'El usuario se eliminó satisfactoriamente');
	}
}
