<?php

namespace App\Http\Livewire\Cuenta;

use App\Models\Banco;
use App\Models\Cuenta;
use Livewire\Component;

class NuevaCuenta extends Component
{
    public $open = false;

    public $numero;
    public $tipo = 0;
    public $letra = 'V';
    public $documento;
    public $beneficiario;
    public $banco_id = 0;
    public $codigo = '0412';
    public $telefono;
    public $publica = false;

    protected $rules = [
        'letra' => 'required',
        'documento' => 'required|min:6|max:10',
        'beneficiario' => 'required|string|max:45',
        'numero' => 'required|numeric|digits:20',
        'banco_id' => 'not_in:0',
        'tipo' => 'not_in:0',
        'codigo' => 'nullable',
        'telefono' => 'nullable|digits:7',
        'publica' => 'boolean',
    ];

    public function render()
    {
        $bancos = Banco::all();

        return view('livewire.cuenta.nueva-cuenta', compact('bancos'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $cuenta = Cuenta::create([
            'numero' => $this->numero,
            'tipo' => $this->tipo,
            'documento' => $this->letra . '-' . $this->documento,
            'beneficiario' => $this->beneficiario,
            'banco_id' => $this->banco_id,
            'publica' => $this->publica,
        ]);

        if ($this->telefono) {
            $cuenta->telefono = $this->codigo . '-' . $this->telefono;
            $cuenta->save();
        }

        $this->reset([
            'open',
            'letra',
            'numero',
            'tipo',
            'documento',
            'beneficiario',
            'banco_id',
            'codigo',
            'telefono',
            'publica',
        ]);

        $this->emitTo('cuenta.tabla-cuenta', 'render');
        toastr()->livewire()->addSuccess('La cuenta se creó satisfactoriamente');
    }
}
