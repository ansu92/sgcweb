<?php

namespace App\Http\Livewire;

use App\Models\Integrante;
use App\Models\Unidad;
use Illuminate\Support\Str;
use Livewire\Component;

class NuevoIntegrante extends Component
{
	public $letra = 'V';
	public $documento;
	public $nombre;
	public $segundoNombre = null;
	public $apellido;
	public $segundoApellido = null;
	public $telefono = null;
	public $email = null;

	public $codigo = '0412';

	public Unidad $unidad;
	
	public $open = false;
	
	protected $rules = [
		'letra' => 'required',
		'documento' => 'required|digits_between:6,8',
		'nombre' => 'required|max:20',
		'segundoNombre' => 'nullable|max:20',
		'apellido' => 'required|max:20',
		'segundoApellido' => 'nullable|max:20',
		'codigo' => 'nullable',
		'telefono' => 'nullable|digits:7',
		'email' => 'nullable|email|max:45',
	];

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedLetra()
	{
		$this->buscarIntegrante();
	}

	public function updatedDocumento()
	{
		$this->buscarIntegrante();
	}

	private function buscarIntegrante()
	{
		$integrante = Integrante::where('letra', $this->letra)
			->where('documento', $this->documento)->first();

		if ($integrante) {
			$this->nombre = $integrante->nombre;
			$this->segundoNombre = $integrante->s_nombre;
			$this->apellido = $integrante->apellido;
			$this->segundoApellido = $integrante->s_apellido;
			$this->codigo = Str::substr($integrante->telefono, 0, 4);
			$this->telefono = Str::substr($integrante->telefono, 5, 7);
			$this->email = $integrante->email;
		} else {
			$this->integrante = new Integrante;
			$this->reset([
				'nombre',
				'segundoNombre',
				'apellido',
				'segundoApellido',
				'codigo',
				'telefono',
				'email',
			]);
		}
	}

	public function save()
	{
		$this->validate();

		$integrante = Integrante::where('letra', $this->letra)
			->where('documento', $this->documento)->first();

		if ($integrante) {
			$integrante->nombre = $this->nombre;
			$integrante->s_nombre = $this->segundoNombre;
			$integrante->apellido = $this->apellido;
			$integrante->s_apellido = $this->segundoApellido;
			$integrante->telefono = $this->codigo . '-' . $this->telefono;
			$integrante->email = $this->email;
			$integrante->unidad_id = $this->unidad->id;
			$integrante->save();
		} else {

			Integrante::create([
				'letra' => $this->letra,
				'documento' => $this->documento,
				'nombre' => $this->nombre,
				's_nombre' => $this->segundoNombre,
				'apellido' => $this->apellido,
				's_apellido' => $this->segundoApellido,
				'telefono' => $this->codigo . '-' . $this->telefono,
				'email' => $this->email,
				'unidad_id' => $this->unidad->id,
			]);
		}

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
		// redirect()->route('unidad.show', $this->unidad);
	}

	public function render()
	{
		return view('livewire.nuevo-integrante');
	}
}
