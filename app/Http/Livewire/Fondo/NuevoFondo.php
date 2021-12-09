<?php

namespace App\Http\Livewire\Fondo;

use App\Models\Cuenta;
use App\Models\Fondo;
use Livewire\Component;

class NuevoFondo extends Component
{
	public $descripcion, $moneda = 'Bolívar', $saldoInicial = 0;
	public Cuenta $cuenta;

	public $open = false;

	protected $rules = [
		'descripcion' => 'required|max:255',
		'saldoInicial' => 'nullable|numeric|gt:0',
		'moneda' => 'required',
		'cuenta.id' => 'nullable',
	];

	protected $messages = [
		// 'cuenta.id.required' => 'Debe seleccionar una cuenta.',
	];

	public function mount() {
		$this->cuenta = new Cuenta;
	}

	public function render()
	{
		$cuentas = Cuenta::doesntHave('fondo')->get();

		return view('livewire.fondo.nuevo-fondo', compact('cuentas'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatingCuenta($value) {
		$this->cuenta = $value == '----' ? new Cuenta : Cuenta::find($value);
	} 

	public function save()
	{
		$this->validate();

		Fondo::create([
			'descripcion' => $this->descripcion,
			'moneda' => $this->moneda,
			'saldo' => $this->saldoInicial,
			'cuenta_id' => $this->cuenta->id
		]);

		$this->reset([
			'open',
			'descripcion',
			'saldoInicial',
			'moneda',
		]);
		$this->cuenta = new Cuenta;

		$this->emitTo('fondo.tabla-fondo', 'render');
		$this->emit('alert', 'El fondo se registró satisfactoriamente');
		toastr()->livewire()->addSuccess('El fondo se registró satisfactoriamente');
	}
}
