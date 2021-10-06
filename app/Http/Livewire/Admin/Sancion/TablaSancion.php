<?php

namespace App\Http\Livewire\Admin\Sancion;

use App\Models\Sancion;
use Livewire\Component;
use Livewire\WithPagination;

class TablaSancion extends Component
{
    
	use WithPagination;

	public Sancion $sancion;

	public $busqueda;
	public $orden = 'descripcion';
	public $direccion = "desc";
	public $cantidad = "10";

	public $openEdit = false;

	protected $listeners = ['render'];

	public $readyToLoad = false;

	public $rules = [
        'sancion.monto' => 'required|numeric|gt:0',
        'sancion.moneda' => 'required',
    ];

	public function render()
	{
		if ($this->readyToLoad) {

			$sanciones = Sancion::where('descripcion', 'like', '%' . $this->busqueda . '%')
				->orderBy($this->orden, $this->direccion)
				->paginate($this->cantidad);
		} else {
			$sanciones = [];
		}

		return view('livewire.admin.sancion.tabla-sancion', compact('sanciones'));
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

	public function edit(Sancion $sancion)
    {
        $this->sancion = $sancion;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();
        $this->sancion->save();
        $this->reset('openEdit');
        $this->emit('alert','El monto se actualizó satisfactoriamente');
    }

}
