<?php

namespace App\Http\Livewire\Banco;

use App\Models\Banco;
use Livewire\Component;

class NuevoBanco extends Component
{

    public $abierto = false;

    public $nombre;

    protected $rules = [
        'nombre' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        Banco::create([
            'nombre' => $this->nombre,
        ]);

        $this->reset([
            'abierto',
            'nombre',
        ]);

        $this->emitTo('banco.tabla-banco', 'render');
        $this->emit('alert', 'El registro se creó satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.banco.nuevo-banco');
    }
}
