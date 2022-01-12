<?php

namespace App\Http\Livewire\Admin\Comunicado;

use App\Models\Comunicado;
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

	public $openDestroy = false;

	protected $listeners = ['render'];

	public function render()
	{
		$comunicados = $this->readyToLoad ?
			Comunicado::where('asunto', 'like', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad)
			: [];

		return view('livewire.admin.comunicado.tabla-comunicado', compact('comunicados'));
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

	public function destroy(Comunicado $comunicado) {
		$this->comunicado = $comunicado;
		$this->openDestroy = true;
	}

	public function delete() {
		$this->comunicado->delete();

		$this->reset('openDestroy');

		toastr()->livewire()->addSuccess('El comunicado se eliminó satisfactoriamente');
	}
}
