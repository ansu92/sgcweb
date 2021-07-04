<?php

namespace App\Http\Livewire\Servicio;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class ShowServicio extends Component
{

    use WithPagination;

    public $proveedor;
    public $servicio;

    public $busqueda = '';
    public $direccion = 'desc';
    public $orden = 'nombre';
    public $cantidad = '10';

    public $readyToLoad = false;


    public function render()
    {
        if ($this->readyToLoad) {
            $proveedores = $this->servicio->proveedores()
                ->where(function ($query) {
                    $query->where('documento', 'like', '%' . $this->busqueda . '%')
                        ->orwhere('nombre', 'like', '%' . $this->busqueda . '%')
                        ->orwhere('contacto', 'like', '%' . $this->busqueda . '%')
                        ->orwhere('telefono', 'like', '%' . $this->busqueda . '%')
                        ->orwhere('email', 'like', '%' . $this->busqueda . '%')
                        ->orwhere('direccion', 'like', '%' . $this->busqueda . '%');
                })
                ->orderBy($this->orden, $this->direccion)
                ->paginate($this->cantidad);
        } else {
            $proveedores = [];
        }
        return view('livewire.servicio.show-servicio', compact('proveedores'));
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

}
