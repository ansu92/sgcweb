<?php

namespace App\Http\Livewire\Admin\Administrador;

use App\Models\Administrador;
use App\Models\Integrante;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class NuevoAdministrador extends Component
{
	public $open = false;

	public $idResponsable;
	public $letra = 'V';
	public $documento;
	public $nombre;
	public $segundoNombre = null;
	public $apellido;
	public $segundoApellido = null;
	public $fecha_nacimiento;
	public $edad;
	public $codigo = '0412';
	public $telefono = null;
	public $email;
	public $rol;

	public Integrante $integrante;

	protected function rules()
	{
		return [
			'idResponsable' => 'unique:administradores,id',
			'letra' => 'required',
			'documento' => [
				'required',
				'digits_between:6,8',
			],
			'nombre' => 'required|max:20',
			'segundoNombre' => 'nullable|max:20',
			'apellido' => 'required|max:20',
			'segundoApellido' => 'nullable|max:20',
			'fecha_nacimiento' => 'required|before_or_equal:today',
			'edad' => 'numeric|gt:18',
			'codigo' => 'nullable',
			'telefono' => 'nullable|digits:7',
			'email' => [
				'required',
				'email',
				'max:45',
				Rule::unique('integrantes')->ignore($this->integrante),
			],
			'rol' => 'required',
		];
	}

	protected $messages = [
		'idResponsable.unique' => 'La persona con esta cédula ya está registrada.',
		'documento.required' => 'El campo cédula es obligatorio.',
		'documento.unique' => 'La cédula ya está registrada',
		'fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
		'fecha_nacimiento.before_or_equal' => 'La fecha no puede ser mayor a la fecha de hoy.',
		'edad.gt' => 'El responsable debe ser mayor de 18 años.'
	];

	public function mount()
	{
		$this->integrante = new Integrante;
	}

	public function render()
	{
		return view('livewire.admin.administrador.nuevo-administrador');
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function updatedLetra()
	{
		$this->buscarIntegrante();
		$this->buscarAdministrador();
	}

	public function updatedDocumento()
	{
		$this->buscarIntegrante();
		$this->buscarAdministrador();
	}

	public function updatedFechaNacimiento()
	{
		$this->edad = Carbon::parse($this->fecha_nacimiento)->age;
		$this->validateOnly('edad');
	}

	private function buscarIntegrante()
	{
		$integrante = Integrante::where('letra', $this->letra)
			->where('documento', $this->documento)->first();

		if ($integrante) {
			$this->integrante = $integrante;

			$this->nombre = $this->integrante->nombre;
			$this->segundoNombre = $this->integrante->s_nombre;
			$this->apellido = $this->integrante->apellido;
			$this->segundoApellido = $this->integrante->s_apellido;
			$this->fecha_nacimiento = $this->integrante->fecha_nacimiento;
			$this->codigo = Str::substr($this->integrante->telefono, 0, 4);
			$this->telefono = Str::substr($this->integrante->telefono, 5, 7);
			$this->email = $this->integrante->email;
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
			]);
		}

		$this->edad = Carbon::parse($this->integrante->fecha_nacimiento)->age;
	}

	public function buscarAdministrador()
	{
		if ($this->integrante->administrador) {
			$this->idResponsable = $this->integrante->administrador->id;

			$this->validateOnly('idResponsable');
		} else {
			$this->reset('idResponsable');
			$this->validateOnly('idResponsable');
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
			$integrante->fecha_nacimiento = $this->fecha_nacimiento;

			if ($this->telefono) {
				$integrante->telefono = $this->codigo . '-' . $this->telefono;
			}

			$integrante->email = $this->email;

			$integrante->save();
		} else {

			$datosIntegrante = [
				'letra' => $this->letra,
				'documento' => $this->documento,
				'nombre' => $this->nombre,
				's_nombre' => $this->segundoNombre,
				'apellido' => $this->apellido,
				's_apellido' => $this->segundoApellido,
				'fecha_nacimiento' => $this->fecha_nacimiento,
				'telefono' => $this->telefono,
				'email' => $this->email,
			];

			if ($this->telefono) {
				$datosIntegrante['telefono'] = $this->codigo . '-' . $this->telefono;
			}

			$integrante = Integrante::create($datosIntegrante);
		}

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
			'fecha_nacimiento',
			'telefono',
			'email',
			'rol',
		]);

		$this->emitTo('administrador.tabla-administrador', 'render');
		$this->emit('alert', 'El administrador se añadió satisfactoriamente');
	}
}
