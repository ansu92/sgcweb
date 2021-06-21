<?php

namespace App\Http\Livewire;

use App\Models\TipoUsuario;
use Livewire\Component;

class NuevoTipoUsuario extends Component
{
	public $abierto = false;

	public $nombre, $descripcion, $area;

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

		TipoUsuario::create([
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
		]);

		$this->reset([
			'abierto',
			'nombre',
			'descripcion',
		]);

		$this->emitTo('tabla-tipo-usuario', 'render');
		$this->emit('alert', 'El registro se creó satisfactoriamente');
	}

	public function render()
	{
		return view('livewire.nuevo-tipo-usuario');
	}
}
