<?php

namespace App\Http\Livewire;

use App\Models\TipoUnidad;
use Livewire\Component;

class NuevoTipoUnidad extends Component
{
    public $abierto = false;

    public $nombre, $descripcion, $area;

    protected $rules = [
        'nombre' => 'required',
        'area' => 'required|numeric',
        'descripcion' => 'max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        TipoUnidad::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'area' => $this->area,
        ]);

        $this->reset([
            'abierto',
            'nombre',
            'descripcion',
            'area',
        ]);

        $this->emitTo('tabla-tipo-unidad', 'render');
        $this->emit('alert', 'El registro se creó satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.nuevo-tipo-unidad');
    }
}
