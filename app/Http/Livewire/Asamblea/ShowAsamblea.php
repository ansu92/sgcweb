<?php

namespace App\Http\Livewire\Asamblea;

use App\Models\Asamblea;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAsamblea extends Component
{
    use WithPagination;

    public Asamblea $asamblea;

    public $busqueda;
    public $orden = 'documento';
    public $direccion = 'desc';
    public $cantidad = '10';

    public $readyToLoad = false;

    public function render()
    {

        if ($this->readyToLoad) {
            $asistentes = $this->asamblea->asistentes()
                ->where(function($query) {
                    $query->where('documento', 'LIKE', '%'.$this->busqueda.'%')
                    ->orWhere('nombre', 'LIKE', '%'.$this->busqueda.'%')
                    ->orWhere('apellido', 'LIKE', '%'.$this->busqueda.'%');
                })
                ->orderBy($this->orden, $this->direccion)
                ->paginate($this->cantidad);

        } else {
            $asistentes = [];
        }

        return view('livewire.asamblea.show-asamblea', compact('asistentes'));
    }

    public function loadAsistentes()
    {
        $this->readyToLoad = true;
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
