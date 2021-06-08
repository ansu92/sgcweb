<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Livewire\Component;

class TablaProveedor extends Component
{
    public $busqueda;
    public $orden = 'nombre';
    public $direccion = "desc";

    protected $listeners = ['render'];

    public function render()
    {
        $proveedores = Proveedor::where('nombre', 'like', '%' . $this->busqueda . '%')
        ->orderBy($this->orden, $this->direccion)
        ->get();

        return view('livewire.tabla-proveedor', compact('proveedores'));
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
