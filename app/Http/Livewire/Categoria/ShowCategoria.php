<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategoria extends Component
{
	use WithPagination;

	public Categoria $categoria;
	
	public $readyToLoad = false;

	public $busqueda;
	public $orden = 'nombre';
	public $direccion = 'asc';
	public $cantidad = '10';

    public function render()
    {
		$servicios = $this->readyToLoad
			?
			$this->categoria->servicios()
			->where(function ($query) {
				$query->where('nombre', 'LIKE', '%' . $this->busqueda . '%')
					->orWhere('descripcion', 'LIKE', '%' . $this->busqueda . '%');
			})
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad)
			:

			$servicios = [];

        return view('livewire.categoria.show-categoria', compact('servicios'));
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
}
