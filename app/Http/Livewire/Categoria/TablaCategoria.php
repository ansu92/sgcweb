<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class TablaCategoria extends Component
{
	use WithPagination;
	
	public $categoria;

	public $busqueda = '';
	public $orden = 'nombre';
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
		$this->categoria = new Categoria;
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$categorias = Categoria::where('nombre', 'like', '%' . $this->busqueda . '%')
				->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$categorias = [];
		}

		return view('livewire.categoria.tabla-categoria', compact('categorias'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatingBusqueda()
	{
		$this->resetPage();
	}

	public function updatingCantidad() {
		$this->resetPage();
	}

	public function loadCategorias()
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

	public function edit(Categoria $categoria)
	{
		$this->categoria = $categoria;
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->categoria->save();

		$this->reset('openEdit');

		$this->emitTo('categoria.tabla-categoria', 'render');
		$this->emit('alert', 'La categoría se actualizó satisfactoriamente');
	}

	public function destroy(Categoria $categoria) {
		$this->categoria = $categoria;
		$this->openDestroy = true;
	}

	public function delete() {
		$this->categoria->delete();

		$this->reset('openDestroy');

		$this->emitTo('categoria.tabla-categoria', 'render');
		$this->emit('alert', 'La categoría se eliminó satisfactoriamente');
	}
}
