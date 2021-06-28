<?php

namespace App\Http\Livewire;

use App\Models\Cuenta;
use Livewire\Component;

class TablaCuenta extends Component
{
    public $busqueda;
	public $orden = 'numero';
	public $direccion = "desc";

	protected $listeners = ['render'];

	public function render()
	{

		$cuentas = Cuenta::where('numero', 'like', '%' . $this->busqueda . '%')
        ->orwhere('tipo','like','%' . $this->busqueda . '%')
        ->orwhere('documento','like','%' . $this->busqueda . '%')
        ->orwhere('beneficiario','like','%' . $this->busqueda . '%')
        ->orwhere('banco_id','like','%' . $this->busqueda . '%')
        ->orderBy($this->orden, $this->direccion)
        ->get();

        return view('livewire.tabla-cuenta', compact('cuentas'));
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
