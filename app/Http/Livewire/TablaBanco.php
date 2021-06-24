<?php

namespace App\Http\Livewire;

use App\Models\Banco;
use Livewire\Component;

class TablaBanco extends Component
{
    public $busqueda;
    public $orden = 'nombre';
    public $direccion = "asc";

    protected $listeners = ['render'];

    public function render()
    {
        $bancos = Banco::where('nombre', 'like', '%' . $this->busqueda . '%')
            ->orderBy($this->orden, $this->direccion)
            ->get();

        return view('livewire.tabla-banco', compact('bancos'));
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
