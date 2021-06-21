<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Illuminate\Support\Str;
use Livewire\Component;

class NuevoProveedor extends Component
{
    public $abierto = false;

    public $documento, $nombre, $contacto, $telefono, $email, $direccion;

    protected $rules = [
        'documento' => 'required|max:12',
        'nombre' => 'required',
        'contacto' => 'required',
        'telefono' => 'required|max:12',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        Proveedor::create([
            'documento' => $this->documento,
            'nombre' => $this->nombre,
            'slug' => Str::slug($this->nombre),
            'contacto' => $this->contacto,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
        ]);

        $this->reset([
            'abierto',
            'documento',
            'nombre',
            'slug',
            'contacto',
            'telefono',
            'email',
            'direccion',
        ]);

        $this->emitTo('tabla-proveedor', 'render');
        $this->emit('alert', 'El registro se creó satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.nuevo-proveedor');
    }
}
