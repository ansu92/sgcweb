<?php

namespace App\Http\Livewire\Admin\Administrador;

use App\Models\Administrador;
use App\Models\Integrante;
use Livewire\Component;

class NuevoAdministrador extends Component
{
	public $open = false;

	public $letra = 'V', $documento, $nombre, $segundoNombre = null, $apellido, $segundoApellido = null, $telefono = null, $email, $rol;

	protected $rules = [
		'letra' => 'required',
		'documento' => 'required|digits_between:6,8|unique:integrantes,documento,NULL,id,deleted_at,NULL',
		'nombre' => 'required|alpha|max:20',
		'segundoNombre' => 'nullable|alpha|max:20',
		'apellido' => 'required|alpha|max:20',
		'segundoApellido' => 'nullable|alpha|max:20',
		'telefono' => 'nullable|regex:/\d{4}-\d{7}/',
		'email' => 'required|email|max:45|unique:integrantes',
		'rol' => 'required',
	];

	public function render()
	{
		return view('livewire.admin.administrador.nuevo-administrador');
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save()
	{
		$this->validate();

		$integrante = Integrante::create([
			'letra' => $this->letra,
			'documento' => $this->documento,
			'nombre' => $this->nombre,
			's_nombre' => $this->segundoNombre,
			'apellido' => $this->apellido,
			's_apellido' => $this->segundoApellido,
			'telefono' => $this->telefono,
			'email' => $this->email,
		]);

		Administrador::create([
			'integrante_id' => $integrante->id,
			'rol' => $this->rol,
		]);

		$this->reset([
			'open',
			'letra',
			'documento',
			'nombre',
			'segundoNombre',
			'apellido',
			'segundoApellido',
			'telefono',
			'email',
			'rol',
		]);

		$this->emitTo('administrador.tabla-administrador', 'render');
		$this->emit('alert', 'El administrador se añadió satisfactoriamente');
	}
}
