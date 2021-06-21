<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class TablaCategoria extends Component
{
    public $busqueda;
    public $orden = 'nombre';
    public $direccion = "asc";

    protected $listeners = ['render'];

    public function render()
    {
        $categorias = Categoria::where('nombre', 'like', '%' . $this->busqueda . '%')
        ->orWhere('descripcion', 'like', '%' . $this->busqueda . '%')
        ->orderBy($this->orden, $this->direccion)
        ->get();

        return view('livewire.tabla-categoria', compact('categorias'));
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
