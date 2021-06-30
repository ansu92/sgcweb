<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class TablaProveedor extends Component
{
	use WithPagination;

	public Proveedor $proveedor;
	public $codigo, $telefono;

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
			// 'proveedor.letra' => 'required',
			// 'proveedor.documento' => 'required|digits_between:6,8|unique:proveedores,documento,' . $this->proveedor->id . ',id,letra,' . $this->proveedor->letra . ',deleted_at,NULL',
			'proveedor.nombre' => 'required',
			'proveedor.contacto' => 'required',
			'codigo' => 'required|not_in:0',
			'telefono' => 'required|digits:7',
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

		return view('livewire.tabla-proveedor', compact('proveedores'));
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

	public function loadFondos()
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

	public function edit(Proveedor $proveedor)
	{
		$this->proveedor = $proveedor;

		$this->codigo = Str::substr($this->proveedor->telefono, 0, 4);
		$this->telefono = Str::substr($this->proveedor->telefono, 5);

		$this->openEdit = true;
	}

	public function update()
	{
		$this->proveedor->telefono = $this->codigo . '-' . $this->telefono;

		$this->validate();

		$this->proveedor->save();

		$this->reset('openEdit');

		$this->emitTo('tabla-proveedor', 'render');
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

		$this->emitTo('tabla-proveedor', 'render');
		$this->emit('alert', 'El proveedor se eliminó satisfactoriamente');
	}
}
