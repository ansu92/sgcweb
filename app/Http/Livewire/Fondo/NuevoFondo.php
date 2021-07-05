<?php

namespace App\Http\Livewire\Fondo;

use App\Models\Fondo;
use Livewire\Component;

class NuevoFondo extends Component
{
	public $descripcion, $moneda = 'Bolívar';

	public $open = false;

	protected $rules = [
		'descripcion' => 'required|max:255',
		'moneda' => 'required'
	];

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save()
	{
		$this->validate();

		Fondo::create([
			'descripcion' => $this->descripcion,
			'moneda' => $this->moneda,
		]);

		$this->reset([
			'open',
			'descripcion',
			'moneda',
		]);

		$this->emitTo('fondo.tabla-fondo', 'render');
		$this->emit('alert', 'El fondo se registró satisfactoriamente');
	}

	public function render()
	{
		return view('livewire.fondo.nuevo-fondo');
	}
}
