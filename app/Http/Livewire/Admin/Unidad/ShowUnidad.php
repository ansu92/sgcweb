<?php

namespace App\Http\Livewire\Admin\Unidad;

use App\Models\Integrante;
use App\Models\Propietario;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class ShowUnidad extends Component
{
	public $documento;
	public Unidad $unidad;
	public Integrante $integrante;

	public $codigo = '0412';
	public $telefono;

	// public Integrante $integrante;

	public $openAsignar = false;
	// public $openDestroy = false;

	protected $listeners = ['render'];

	protected $rules = [
		'documento' => 'required|digits_between:8,20',
		'integrante.letra' => 'required',
		'integrante.documento' => 'required|digits_between:6,8',
		'integrante.nombre' => 'required|alpha|max:20',
		'integrante.s_nombre' => 'nullable|alpha|max:20',
		'integrante.apellido' => 'required|alpha|max:20',
		'integrante.s_apellido' => 'nullable|alpha|max:20',
		'codigo' => 'nullable',
		'telefono' => 'nullable|digits:7',
		'integrante.email' => 'required|email|max:45',
	];

	public function mount()
	{
		$this->integrante = new Integrante;
		$this->integrante->letra = 'V';
	}

	public function render()
	{
		return view('livewire.admin.unidad.show-unidad');
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedIntegranteDocumento()
	{
		$integrante = Integrante::where('letra', $this->integrante->letra)
			->where('documento', $this->integrante->documento)->first();

		if ($integrante) {
			$this->integrante = $integrante;
			$this->codigo = Str::substr($integrante->telefono, 0, 4);
			$this->telefono = Str::substr($integrante->telefono, 5, 7);
		}
	}

	public function asignarPropietario()
	{
		$this->validate();

		$integrante = Integrante::where('letra', $this->integrante->letra)
			->where('documento', $this->integrante->documento)->first();

		if ($integrante) {
			$this->integrante = $integrante;
		} else {
			$this->integrante->telefono = $this->codigo . '-' . $this->telefono;
			$this->integrante->save();
		}

		$propietario = new Propietario;
		$propietario->documento = $this->documento;
		$propietario->integrante()->associate($this->integrante);
		$propietario->user()->associate(User::create([
			'name' => $this->integrante->nombre . ' ' . $this->integrante->apellido,
			'email' => $this->integrante->email,
			'password' => bcrypt('password'),
		]));

		$propietario->save();

		$this->unidad->propietario()->associate($propietario);
		$this->unidad->save();

		$this->reset([
			'openAsignar',
			'documento',
			'codigo',
			'telefono',
		]);

		$this->unidad = new Unidad;
		$this->integrante = new Integrante;

		$this->emit('alert', 'El propietario fue asignado satisfactoriamente');
	}

	// public function destroy(Integrante $integrante)
	// {
	// 	$this->integrante = $integrante;
	// 	$this->openDestroy = true;
	// }

	// public function remove()
	// {
	// 	$this->integrante->delete();

	// 	$this->reset('openDestroy');

	// 	$this->emitTo('unidad.show-unidad', 'render');
	// 	$this->emit('alert', 'El integrante fue removido satisfactoriamente');
	// }
}
