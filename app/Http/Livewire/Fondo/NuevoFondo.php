<?php

namespace App\Http\Livewire\Fondo;

use App\Models\Fondo;
use Livewire\Component;

class NuevoFondo extends Component
{
	public $descripcion, $moneda = 'Bolívar', $saldoInicial = 0;

	public $open = false;

	protected $rules = [
		'descripcion' => 'required|max:255',
		'saldoInicial' => 'nullable|numeric',
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
			'saldo' => $this->saldoInicial,
		]);

		$this->reset([
			'open',
			'descripcion',
			'saldoInicial',
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
