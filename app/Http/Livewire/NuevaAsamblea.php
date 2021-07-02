<?php

namespace App\Http\Livewire;

use App\Models\Asamblea;
use App\Models\Integrante;
use Livewire\Component;
use Livewire\WithPagination;

class NuevaAsamblea extends Component
{
    use WithPagination;

    public $descripcion, $fecha, $observacion;
    public $asistentes = [];
    public $count = 0;
    // public $integrantes;

    public $abierto = false;

    public $busqueda = '';
    public $orden = 'documento';
    public $direccion = 'desc';
    public $cantidad = '10';

    public $readyToLoad = false;

    public $rules = [
        'descripcion' => 'required',
        'fecha' => 'required',
        'observacion' => 'nullable',
        'asistentes' => 'required',
    ];

    public function mount()
    {
        // $this->integrantes = Integrante::all();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $integrantes = Integrante::where('documento', 'like', '%' . $this->busqueda . '%')
                ->orwhere('nombre', 'like', '%' . $this->busqueda . '%')
                ->orwhere('apellido', 'like', '%' . $this->busqueda . '%')
                ->orderBy($this->orden, $this->direccion)
                ->paginate($this->cantidad);
        } else {
            $integrantes = [];
        }
        return view('livewire.nueva-asamblea', compact('integrantes'));
    }

    public function loadIntegrantes()
    {
        $this->readyToLoad = true;
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
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

    function save()
    {
        $this->count++;
        $this->validate();
        $this->count++;
        
        $asamblea = Asamblea::create([
            'descripcion'=> $this->descripcion,
            'fecha'=> $this->fecha,
            'observaciones'=> $this->observacion,
        ]);
        $this->count++;
        
        $asamblea->asistentes()->attach($this->asistentes);
        $this->count++;

        $this->emitTo('tabla-asamblea', 'render');

        $this->abierto = false;
    }

}
