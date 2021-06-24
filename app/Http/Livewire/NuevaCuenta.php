<?php

namespace App\Http\Livewire;

use App\Models\Cuenta;
use Livewire\Component;

class NuevaCuenta extends Component
{

    public $abierto = false;

    public $numero;
    public $tipo;
    public $documento;
    public $beneficiario;
    public $banco_id;

    protected $rules = [
        'numero' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        Cuenta::create([
            'numero' => $this->nombre,
            'tipo' => $this->tipo,
            'documento' => $this->documento,
            'beneficiario' => $this->beneficiario,
            'banco_id' => $this->banco_id
        ]);

        $this->reset([
            'abierto',
            'numero',
            'tipo',
            'documento',
            'beneficiario',
            'banco_id',
        ]);

        $this->emitTo('tabla-cuenta', 'render');
        $this->emit('alert', 'El registro se creó satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.nueva-cuenta');
    }
}
