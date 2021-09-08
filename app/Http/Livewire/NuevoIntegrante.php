<?php

namespace App\Http\Livewire;

use App\Models\Integrante;
use App\Models\Unidad;
use Livewire\Component;

class NuevoIntegrante extends Component
{
	public $open = false;
	public $letra = 'V', $codigo;

	public Unidad $unidad;

	public $documento, $nombre, $segundoNombre = null, $apellido, $segundoApellido = null, $telefono = null, $email = null;

    protected $rules = [
        'letra' => 'required',
        'documento' => 'required|digits_between:6,8',
        'nombre' => 'required|alpha|max:20',
        'segundoNombre' => 'nullable|alpha|max:20',
        'apellido' => 'required|alpha|max:20',
        'segundoApellido' => 'nullable|alpha|max:20',
        'codigo' => 'nullable',
        'telefono' => 'nullable|digits:7',
        'email' => 'nullable|email|max:45',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        Integrante::create([
			'letra' => $this->letra,
            'documento' => $this->documento,
            'nombre' => $this->nombre,
            's_nombre' => $this->segundoNombre,
            'apellido' => $this->apellido,
            's_apellido' => $this->segundoApellido,
            'telefono' => $this->codigo.'-'.$this->telefono,
            'email' => $this->email,
			'unidad_id' => $this->unidad->id,
        ]);

        $this->reset([
            'open',
            'letra',
            'documento',
            'nombre',
            'segundoNombre',
            'apellido',
            'segundoApellido',
            'codigo',
            'telefono',
            'email',
        ]);

        $this->emitTo('unidad.show-unidad', 'render');
        $this->emit('alert', 'El integrante se añadió satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.nuevo-integrante');
    }
}
