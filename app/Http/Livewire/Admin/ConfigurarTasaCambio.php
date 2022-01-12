<?php

namespace App\Http\Livewire\Admin;

use App\Models\TasaCambio;
use Livewire\Component;

class ConfigurarTasaCambio extends Component
{
    public $open = false;

    public TasaCambio $tasa;

    public $busqueda = '';
    public $orden = 'created_at';
    public $direccion = 'desc';
    public $cantidad = '10';

    protected $rules = [
        'tasa.tasa' => 'required|numeric|gt:0',
    ];

    protected $messages = [
        'tasa.tasa.required' => 'La tasa de cambio es obligatoria.',
        'tasa.tasa.numeric' => 'La tasa de cambio debe ser un número.',
        'tasa.tasa.gt' => 'La tasa de cambio debe ser mayor a :value.',
    ];

    public function mount()
    {
        $this->tasa = TasaCambio::orderBy('created_at', 'desc')->firstOrNew();
    }

    public function render()
    {
        $listaTasas = TasaCambio::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
            ->orderBy($this->orden, $this->direccion)
            ->paginate($this->cantidad);

        return view('livewire.admin.configurar-tasa-cambio', compact('listaTasas'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function actualizar()
    {
        $this->validate();

        if ($this->tasa) {

            if ($this->tasa->isDirty()) {

                TasaCambio::create([
                    'tasa' => $this->tasa->tasa,
                    'fecha' => now(),
                ]);
            }
        } else {
            $this->fecha = now();
            $this->tasa->save();
        }

        $this->reset('open');

        toastr()->livewire()->addSuccess('La tasa de cambio fue actualizada con éxito');
    }
}
