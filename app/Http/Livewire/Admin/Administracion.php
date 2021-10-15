<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mensualidad;
use Livewire\Component;

class Administracion extends Component
{
    public $monto;
    public $moneda = 'Bolívar';

    public $openMensualidad = false;

    public $orden = 'created_at', $cantidad = 10, $busqueda = '', $direccion = 'desc';

    protected $rules = [
        'monto' => 'required|numeric|gt:0',
        'moneda' => 'required',
    ];

    public function mount()
    {
        $this->monto = Mensualidad::orderBy('created_at', 'desc')->first()->monto;
        $this->moneda = Mensualidad::orderBy('created_at', 'desc')->first()->moneda;
    }

    public function render()
    {
        $mensualidades = Mensualidad::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
            ->orderBy($this->orden, $this->direccion)
            ->paginate($this->cantidad);

        return view('livewire.admin.administracion', compact('mensualidades'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function actualizar()
    {
        $this->validate();

        Mensualidad::create([
            'monto' => $this->monto,
            'moneda' => $this->moneda,
        ]);

        $this->reset('openMensualidad');

        $this->monto = Mensualidad::orderBy('created_at', 'desc')->first()->monto;
        $this->moneda = Mensualidad::orderBy('created_at', 'desc')->first()->moneda;

        $this->emit('alert', 'La mensaulidad fue actualizada con éxito');
    }
}
