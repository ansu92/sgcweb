<?php

namespace App\Http\Livewire\Admin\Unidad;

use App\Models\TipoUnidad;
use App\Models\Unidad;
use Livewire\Component;

class NuevaUnidad extends Component
{
	public $numero;
	public $direccion;
	public TipoUnidad $tipo;

	public $tipoUnidades;

	public $open = false;

	protected $rules = [
		'numero' => 'required|numeric',
		'tipo.id' => 'required',
		'direccion' => 'required|max:255',
	];

	protected $messages = [
		'tipo.id.required' => 'Debe seleccionar un tipo de unidad.',
	];
	
	public function mount() {
		$this->tipo = new TipoUnidad;
		$this->tipoUnidades = TipoUnidad::all();
	}

    public function render()
    {
        return view('livewire.admin.unidad.nueva-unidad');
    }

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save() {
		$this->validate();

		Unidad::create([
			'numero' => $this->numero,
			'tipo_unidad_id' => $this->tipo->id,
			'direccion' => $this->direccion,
		]);

		$this->reset([
			'open',
			'numero',
			'direccion',
		]);

		$this->tipo = new TipoUnidad;

		$this->emitTo('admin.unidad.tabla-unidad', 'render');
		$this->emit('alert', 'La unidad se registró satisfactoriamente');
	}
}
