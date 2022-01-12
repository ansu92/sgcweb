<?php

namespace App\Http\Livewire\Unidad;

use App\Models\Enfermedad;
use App\Models\Integrante;
use App\Models\Medicamento;
use App\Models\Unidad;
use Livewire\Component;
use Illuminate\Support\Str;

class ShowUnidad extends Component
{
	public Unidad $unidad;

	public Integrante $integrante;

	public $enfermedades = [];
	public $medicamentos = [];

	public $codigo = '0412';
	public $telefono;

	public $openEdit = false;
	public $openDestroy = false;

	protected $rules = [
		'integrante.letra' => 'nullable',
		'integrante.documento' => 'nullable|digits_between:6,8',
		'integrante.nombre' => 'required|max:20',
		'integrante.s_nombre' => 'nullable|max:20',
		'integrante.apellido' => 'required|max:20',
		'integrante.s_apellido' => 'nullable|max:20',
		'integrante.fecha_nacimiento' => 'required|before_or_equal:today',
		'codigo' => 'nullable',
		'telefono' => 'nullable|digits:7',
		'integrante.email' => 'nullable|email|max:45',
	];

	protected $listeners = ['render'];

	public function render()
	{
		$listaEnfermedades = Enfermedad::orderBy('nombre')->get();
		$listaMedicamentos = Medicamento::orderBy('nombre')->get();

		return view('livewire.unidad.show-unidad', compact('listaEnfermedades', 'listaMedicamentos'));
	}

	public function edit(Integrante $integrante)
	{
		$this->integrante = $integrante;

		if($integrante->documento == '') {
			$this->integrante->letra = 'V';
		}

		$this->codigo = Str::substr($integrante->telefono, 0, 4);
		$this->telefono = Str::substr($integrante->telefono, 5, 7);
		$this->enfermedades = $integrante->enfermedades()->pluck('enfermedades.id')->toArray();
		$this->medicamentos = $integrante->medicamentos()->pluck('medicamentos.id')->toArray();
		
		$this->openEdit = true;
	}

	public function update()
	{
		$this->validate();

		$this->integrante->telefono = $this->codigo . '-' . $this->telefono;
		$this->integrante->enfermedades()->sync($this->enfermedades);
		$this->integrante->medicamentos()->sync($this->medicamentos);
		$this->integrante->save();

		$this->reset('openEdit');

		$this->emitTo('unidad.show-unidad', 'render');
		toastr()->livewire()->addSuccess('El integrante se actualizó satisfactoriamente');
	}

	public function removerIntegrante(Integrante $integrante)
	{
		$this->integrante = $integrante;
		$this->openDestroy = true;
	}

	public function remove()
	{
		$this->integrante->unidad()->dissociate($this->unidad);
		$this->integrante->save();

		$this->reset('openDestroy');

		$this->emitTo('unidad.show-unidad', 'render');
		toastr()->livewire()->addSuccess('El integrante fue removido satisfactoriamente');
	}
}
