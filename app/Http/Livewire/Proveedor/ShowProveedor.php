<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProveedor extends Component
{

    use WithPagination;

    public $proveedor;

    public $servicio;

    public $openDestroy = false;

    public $busqueda = '';
    public $direccion = 'desc';
    public $orden = 'nombre';
    public $cantidad = '10';

    public $readyToLoad = false;

    public function render()
    {
        if($this->readyToLoad){
        $servicios = $this->proveedor->servicios()
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->busqueda . '%')
                    ->orWhere('descripcion', 'like', '%' . $this->busqueda . '%');
            })
            ->orderBy($this->orden, $this->direccion)
            ->paginate($this->cantidad);
        }else{
            $servicios = [];
        }
        return view('livewire.proveedor.show-proveedor', compact('servicios'));
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

    public function destroy(Servicio $servicio) {
		$this->servicio = $servicio;
		$this->openDestroy = true;
	}

    public function removeServicios(){


        $this->proveedor->servicios()->detach($this->servicio);

        $this->reset('openDestroy');

		toastr()->livewire()->addSuccess('El servicio fue removido satisfactoriamente');
		

    }
}
