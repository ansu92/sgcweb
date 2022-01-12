<?php

namespace App\Http\Livewire\Admin\Administrador;

use App\Models\Administrador;
use App\Models\Integrante;
use Livewire\Component;
use Livewire\WithPagination;

class TablaAdministrador extends Component
{
	use WithPagination;

	public Administrador $administrador;

	public $busqueda;
	public $orden = 'id';
	public $direccion = 'desc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected function rules()
	{
		return [
			// 'administrador.integrante.letra' => 'required',
			// 'administrador.integrante.documento' => 'required',
			// 'administrador.integrante.nombre' => 'required',
			// 'administrador.integrante.s_nombre' => 'nullable',
			// 'administrador.integrante.apellido' => 'required',
			// 'administrador.integrante.s_apellido' => 'nullable',
			// 'administrador.integrante.telefono' => 'nullable',
			// 'administrador.integrante.email' => 'nullable',
			'administrador.rol' => 'required',
		];
	}

	protected $listeners = ['render'];

	public function render()
	{
		$administradores = $this->readyToLoad ? Administrador::paginate($this->cantidad) : [];

		return view('livewire.admin.administrador.tabla-administrador', compact('administradores'));
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

	public function edit(Administrador $administrador)
	{
		$this->administrador = $administrador;

		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->administrador->save();

		$this->reset('openEdit');

		toastr()->livewire()->addSuccess('El administrador se actualizó satisfactoriamente');
	}

	public function destroy(Administrador $administrador)
	{
		$this->administrador = $administrador;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->administrador->delete();

		$this->reset('openDestroy');

		toastr()->livewire()->addSuccess('El administrador se eliminó satisfactoriamente');
	}
}
