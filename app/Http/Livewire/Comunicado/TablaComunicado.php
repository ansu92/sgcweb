<?php

namespace App\Http\Livewire\Comunicado;

use App\Models\Comunicado;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TablaComunicado extends Component
{
	use WithPagination;

	public Comunicado $comunicado;

	public $busqueda = '';
	public $orden = 'created_at';
	public $direccion = "asc";
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'comunicado.asunto' => 'required|max:45',
		'comunicado.contenido' => 'required',
	];

	protected $listeners = ['render'];

	public function render()
	{
		$comunicados = $this->readyToLoad ?
			Auth::user()->administrador->comunicados()->where('asunto', 'like', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad)
			: [];

		return view('livewire.comunicado.tabla-comunicado', compact('comunicados'));
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

	public function edit(Comunicado $comunicado)
	{
		$this->comunicado = $comunicado;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->comunicado->save();

		$this->reset('openEdit');

		$this->emitTo('comunicado.tabla-comunicado', 'render');
		toastr()->livewire()->addSuccess('El comunicado se actualizó satisfactoriamente');
	}
}
