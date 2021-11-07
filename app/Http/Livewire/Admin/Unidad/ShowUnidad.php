<?php

namespace App\Http\Livewire\Admin\Unidad;

use App\Models\Integrante;
use App\Models\Propietario;
use App\Models\Unidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class ShowUnidad extends Component
{
	public Unidad $unidad;
	public Integrante $integrante;

	public $documento;
	public $letra = 'V';
	public $ci;
	public $codigo = '0412';
	public $telefono;
	public $edad;

	public $openAsignar = false;
	public $openCambiar = false;
	public $openRetirar = false;
	// public $openDestroy = false;

	protected $listeners = ['render'];

	protected function rules()
	{
		$rules = [
			'documento' => 'required|digits_between:8,20|unique:unidades,documento',
			'letra' => 'required',
			'ci' => 'required|digits_between:6,8',
			'integrante.nombre' => 'required|max:20',
			'integrante.s_nombre' => 'nullable|max:20',
			'integrante.apellido' => 'required|max:20',
			'integrante.s_apellido' => 'nullable|max:20',
			'integrante.fecha_nacimiento' => 'required|before_or_equal:today',
			'codigo' => 'nullable',
			'telefono' => 'nullable|digits:7',
		];

		if ($this->integrante->id) {
			$rules['integrante.email'] = 'required|email|max:45|unique:integrantes,email,' . $this->integrante->id;
		} else {

			$rules['integrante.email'] = 'required|email|max:45|unique:integrantes,email';
		}

		return $rules;
	}

	public function mount()
	{
		$this->integrante = new Integrante;
	}

	public function render()
	{
		return view('livewire.admin.unidad.show-unidad');
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedLetra()
	{
		$this->buscarIntegrante();
	}

	public function updatedCi()
	{
		$this->buscarIntegrante();
	}

	public function updatedIntegranteFechaNacimiento()
	{
		$this->edad = Carbon::parse($this->integrante->fecha_nacimiento)->age;
	}

	private function buscarIntegrante()
	{
		$integrante = Integrante::where('letra', $this->letra)
			->where('documento', $this->ci)->first();

		if ($integrante) {
			$this->integrante = $integrante;
			$this->codigo = Str::substr($integrante->telefono, 0, 4);
			$this->telefono = Str::substr($integrante->telefono, 5, 7);
		} else {
			$this->integrante = new Integrante;
			$this->reset(['codigo', 'telefono']);
		}

		$this->edad = Carbon::parse($this->integrante->fecha_nacimiento)->age;
	}

	public function asignarPropietario()
	{
		$this->validate();

		$integrante = $this->integrante;
		$integrante->letra = $this->letra;
		$integrante->documento = $this->ci;
		$integrante->telefono = $this->codigo . '-' . $this->telefono;
		$integrante->save();

		if ($integrante->propietario) {
			$this->unidad->propietario()->associate($integrante->propietario);
		} else {
			$propietario = new Propietario;
			$propietario->integrante()->associate($integrante);

			$propietario->user()->associate(User::create([
				'name' => $integrante->nombre . ' ' . $integrante->apellido,
				'email' => $integrante->email,
				'password' => bcrypt('password'),
			]));

			$propietario->save();
			$this->unidad->propietario()->associate($propietario);
		}

		$this->unidad->documento = $this->documento;
		$this->unidad->save();

		$this->reset([
			'openAsignar',
			'documento',
			'letra',
			'ci',
			'codigo',
			'telefono',
		]);

		$this->integrante = new Integrante;

		$this->emit('alert', 'El propietario fue asignado satisfactoriamente');
	}

	public function cambiarPropietario()
	{
		$this->validate();

		$this->retirar();
		$this->asignarPropietario();

		$this->reset('openCambiar');
	}

	public function retirar()
	{
		$integrantes = $this->unidad->integrantes;

		foreach ($integrantes as $item) {
			$item->unidad()->dissociate();
			$item->save();
		}

		$this->unidad->propietario()->dissociate();
		$this->unidad->documento = null;
		$this->unidad->save();

		$this->reset('openRetirar');
	}
}
