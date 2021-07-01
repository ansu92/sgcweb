<?php

namespace App\Http\Livewire\Servicio;

use App\Models\Categoria;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class TablaServicio extends Component
{
	use WithPagination;

	public Servicio $servicio;

	public $busqueda;
	public $orden = 'nombre';
	public $direccion = 'asc';
	public $cantidad = '10';

	public $readyToLoad = false;

	public $openEdit = false;
	public $openDestroy = false;

	protected $listeners = ['render'];

	public function mount(Servicio $servicio)
	{
		$this->servicio = $servicio;
	}

	protected function rules()
	{
		return [
			'servicio.nombre' => [
				'required',
				'max:60',
				'unique:servicios,nombre,' . $this->servicio->id.',id,deleted_at,NULL',
			],
			'servicio.descripcion' => 'nullable',
			'servicio.categoria_id' => 'required|not_in:0',
		];
	}

	public function render()
	{
		if ($this->readyToLoad) {
			$servicios = Servicio::where('nombre', 'like', '%' . $this->busqueda . '%')
				->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$servicios = [];
		}

		$categorias = Categoria::all();

		return view('livewire.servicio.tabla-servicio', compact('servicios', 'categorias'));
	}

	public function loadServicios()
	{
		$this->readyToLoad = true;
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

	public function edit(Servicio $servicio)
	{
		$this->servicio = $servicio;

		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->servicio->save();

		$this->reset('openEdit');

		$this->emitTo('servicio.tabla-servicio', 'render');
		$this->emit('alert', 'El servicio se actualizó satisfactoriamente');
	}

	public function destroy(Servicio $servicio)
	{
		$this->servicio = $servicio;
		$this->openDestroy = true;
	}

	public function delete()
	{
		$this->servicio->delete();

		$this->reset('openDestroy');

		$this->emitTo('servicio.tabla-servicio', 'render');
		$this->emit('alert', 'El servicio se eliminó satisfactoriamente');
	}
}
