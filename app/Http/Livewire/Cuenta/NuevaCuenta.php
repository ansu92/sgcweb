<?php

namespace App\Http\Livewire\Cuenta;

use App\Models\Banco;
use App\Models\Cuenta;
use Livewire\Component;

class NuevaCuenta extends Component
{

    public $abierto = false;

    public $numero;
    public $tipo = 0;
    public $letra = 'V';
    public $documento;
    public $beneficiario;
    public $banco_id = 0;

    public $bancos;

    protected $rules = [
        'letra' => 'required',
		'documento' => 'required|digits_between:6,10',
		'beneficiario' => 'required|string|max:45',
		'numero' => 'required|numeric|digits:20',
		'banco_id' => 'not_in:0',
		'tipo' => 'not_in:0',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        Cuenta::create([
            'numero' => $this->numero,
            'tipo' => $this->tipo,
            'documento' => $this->letra.'-'.$this->documento,
            'beneficiario' => $this->beneficiario,
            'banco_id' => $this->banco_id
        ]);

        $this->reset([
            'abierto',
            'letra',
            'numero',
            'tipo',
            'documento',
            'beneficiario',
            'banco_id',
        ]);

        $this->emitTo('cuenta.tabla-cuenta', 'render');
        $this->emit('alert', 'El registro se creó satisfactoriamente');
    }

    public function render()
    {
        $this->bancos = Banco::all();
        return view('livewire.cuenta.nueva-cuenta');

    }
}
