<?php

namespace App\Http\Livewire\Asamblea;

use App\Models\Asamblea;
use App\Models\Integrante;
use Livewire\Component;
use Livewire\WithPagination;

class TablaAsamblea extends Component
{
    use WithPagination;

    public $asamblea;

    public $busqueda;
    public $orden = 'fecha';
    public $direccion = 'desc';
    public $cantidad = '10';

    public $readyToLoad = false;

    public $integrantes = [];

    public $listeners = ['render'];

    public function mount()
    {
        $this->asamblea = new Asamblea();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $asambleas = Asamblea::where('descripcion', 'like', '%' . $this->busqueda . '%')
                ->orwhere('fecha', 'like', '%' . $this->busqueda . '%')
                ->orderBy($this->orden, $this->direccion)
                ->paginate($this->cantidad);
        } else {
            $asambleas = [];
        }

        return view('livewire.asamblea.tabla-asamblea', compact('asambleas'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function loadAsambleas()
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
        if($this->orden == $orden){
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

    public function edit(Asamblea $asamblea)
    {
        $this->integrantes = Integrante::all();
        $this->asamblea = $asamblea;
        $this-> true;
    }
}
