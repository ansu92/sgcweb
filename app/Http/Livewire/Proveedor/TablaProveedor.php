<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class TablaProveedor extends Component
{
	use WithPagination;

	public Proveedor $proveedor;

	public $busqueda;
	public $orden = 'nombre';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected function rules()
	{
		return [
			'proveedor.letra' => '',
			'proveedor.documento' => '',
			'proveedor.nombre' => 'required',
			'proveedor.contacto' => 'required',
			'proveedor.telefono' => [
				'required',
				'regex:/\d{4}-\d{7}/',
			],
			'proveedor.email' => 'nullable|email|unique:proveedores,email,' . $this->proveedor->id,
			'proveedor.direccion' => 'nullable',
		];
	}

	protected $listeners = ['render'];

	public function mount(Proveedor $proveedor)
	{
		$this->proveedor = $proveedor;
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$proveedores = Proveedor::where('documento', 'like', '%' . $this->busqueda . '%')
				->orWhere('nombre', 'like', '%' . $this->busqueda . '%')
				->orWhere('contacto', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$proveedores = [];
		}

		return view('livewire.proveedor.tabla-proveedor', compact('proveedores'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedProveedorLetra()
	{
		$this->validateOnly('proveedor.letra');
		$this->validateOnly('proveedor.documento');
	}

	public function updatedProveedorDocumento()
	{
		$this->validateOnly('proveedor.documento');
		$this->validateOnly('proveedor.letra');
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

	public function edit(Proveedor $proveedor)
	{
		$this->proveedor = $proveedor;

		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->proveedor->save();

		$this->reset('openEdit');

		$this->emit('alert', 'El proveedor se actualizó satisfactoriamente');
	}

	public function destroy(Proveedor $proveedor)
	{
		$this->proveedor = $proveedor;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->proveedor->delete();

		$this->reset('openDestroy');

		$this->emit('alert', 'El proveedor se eliminó satisfactoriamente');
	}
}
