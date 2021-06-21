<?php

namespace App\Http\Livewire;

use App\Models\TipoUsuario;
use Livewire\Component;

class TablaTipoUsuario extends Component
{
	public $busqueda;
	public $orden = 'nombre';
	public $direccion = "asc";

	protected $listeners = ['render'];

	public function render()
	{
		$tipoUsuarios = TipoUsuario::where('nombre', 'like', '%' . $this->busqueda . '%')
			->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->get();

        return view( 'livewire.tabla-tipo-usuario', compact('tipoUsuarios'));
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
