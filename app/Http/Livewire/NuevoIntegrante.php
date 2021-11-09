<?php

namespace App\Http\Livewire;

use App\Models\Enfermedad;
use App\Models\Integrante;
use App\Models\Medicamento;
use App\Models\Unidad;
use Carbon\Carbon;
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
	public $fecha_nacimiento;
	public $edad;
	public $telefono = null;
	public $email = null;

	public $enfermedades = [];
	public $medicamentos = [];

	public $codigo = '0412';

	public Unidad $unidad;

	public $open = false;

	protected $rules = [
		'letra' => 'required',
		'documento' => 'nullable|digits_between:6,8',
		'nombre' => 'required|max:20',
		'segundoNombre' => 'nullable|max:20',
		'apellido' => 'required|max:20',
		'segundoApellido' => 'nullable|max:20',
		'fecha_nacimiento' => 'required|before_or_equal:today',
		'codigo' => 'nullable',
		'telefono' => 'nullable|digits:7',
		'email' => 'nullable|email|max:45|unique:integrantes',
	];

	protected $messages = [
		'documento.required' => 'El campo cédula es obligatorio.',
		'fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
		'fecha_nacimiento.before_or_equal' => 'La fecha no puede ser mayor a la fecha de hoy.',
	];

	public function render()
	{
		$listaEnfermedades = Enfermedad::orderBy('nombre')->get();
		$listaMedicamentos = Medicamento::orderBy('nombre')->get();

		return view('livewire.nuevo-integrante', compact('listaEnfermedades', 'listaMedicamentos'));
	}

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

	public function updatedFechaNacimiento()
	{
		$this->edad = Carbon::parse($this->fecha_nacimiento)->age;
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
			$this->fecha_nacimiento = $integrante->fecha_nacimiento;
			$this->codigo = Str::substr($integrante->telefono, 0, 4);
			$this->telefono = Str::substr($integrante->telefono, 5, 7);
			$this->email = $integrante->email;
			$this->enfermedades = $integrante->enfermedades()->pluck('enfermedades.id')->toArray();
			$this->medicamentos = $integrante->medicamentos()->pluck('medicamentos.id')->toArray();
		} else {
			$this->integrante = new Integrante;

			$this->reset([
				'nombre',
				'segundoNombre',
				'apellido',
				'segundoApellido',
				'fecha_nacimiento',
				'codigo',
				'telefono',
				'email',
				'enfermedades',
				'medicamentos',
			]);
		}
	}

	public function save()
	{
		$this->validate();

		$integrante = new Integrante;

		if ($this->documento != '') {
			$integrante = Integrante::where('letra', $this->letra)
				->where('documento', $this->documento)->first();
		}

		if ($integrante) {
			$integrante->nombre = $this->nombre;
			$integrante->s_nombre = $this->segundoNombre;
			$integrante->apellido = $this->apellido;
			$integrante->s_apellido = $this->segundoApellido;
			$integrante->fecha_nacimiento = $this->fecha_nacimiento;

			if ($this->telefono) {
				$integrante->telefono = $this->codigo . '-' . $this->telefono;
			}

			$integrante->email = $this->email;
			$integrante->unidad_id = $this->unidad->id;
			$integrante->save();
		} else {

			$datosIntegrante = [
				'nombre' => $this->nombre,
				's_nombre' => $this->segundoNombre,
				'apellido' => $this->apellido,
				'fecha_nacimiento' => $this->fecha_nacimiento,
				's_apellido' => $this->segundoApellido,
				'email' => $this->email,
				'unidad_id' => $this->unidad->id,
			];

			if ($this->documento != '') {
				$datosIntegrante['letra'] = $this->letra;
				$datosIntegrante['documento'] = $this->documento;
			}

			if ($this->telefono) {
				$datosIntegrante['telefono'] = $this->codigo . '-' . $this->telefono;
			}

			$integrante = Integrante::create($datosIntegrante);
		}

		$integrante->enfermedades()->sync($this->enfermedades);
		$integrante->medicamentos()->sync($this->medicamentos);

		$this->reset('open');

		$this->reset([
			'letra',
			'documento',
			'nombre',
			'segundoNombre',
			'apellido',
			'segundoApellido',
			'fecha_nacimiento',
			'codigo',
			'telefono',
			'email',
			'enfermedades',
			'medicamentos',
		]);

		$this->emitTo('unidad.show-unidad', 'render');
		$this->emit('alert', 'El integrante se añadió satisfactoriamente');
	}
}
