<?php

namespace App\Http\Livewire\Admin;

use App\Models\Interes;
use Livewire\Component;

class ConfigurarInteres extends Component
{
    public $open = false;

    public $interes;

    public $busqueda = '';
    public $orden = 'created_at';
    public $direccion = 'desc';
    public $cantidad = '10';

    protected $rules = [
        'interes.factor' => 'required|numeric|gt:0|lte:5',
        'interes.meses' => 'required|numeric|gt:0',
        'interes.estado' => 'boolean',
    ];

    protected $messages = [
        'interes.factor.gt' => 'El factor debe ser mayor a :value%.',
        'interes.factor.lte' => 'El factor no puede ser mayor a :value%.',
    ];

    public function mount()
    {
        $this->interes = Interes::orderBy('created_at', 'desc')->firstOrNew();
    }

    public function render()
    {
        $intereses = Interes::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
            ->orderBy($this->orden, $this->direccion)
            ->paginate($this->cantidad);

        return view('livewire.admin.configurar-interes', compact('intereses'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function actualizar()
    {
        $this->validate();

        if ($this->interes) {

            if ($this->interes->isDirty(['factor', 'meses'])) {

                Interes::create([
                    'factor' => $this->interes->factor,
                    'meses' => $this->interes->meses,
                    'estado' => $this->interes->estado,
                ]);
            } else if ($this->interes->isDirty('estado')) {
                $this->interes->save();
            }
        } else {
            Interes::create([
                'factor' => $this->interes->factor,
                'meses' => $this->interes->meses,
                'estado' => $this->interes->estado,
            ]);
        }

        $this->reset('open');

        $this->emit('alert', 'El interés fue actualizado con éxito');
    }
}
