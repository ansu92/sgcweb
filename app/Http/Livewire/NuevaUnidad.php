<?php

namespace App\Http\Livewire;

use App\Models\TipoUnidad;
use App\Models\Unidad;
use Livewire\Component;

class NuevaUnidad extends Component
{
	public $numero, $direccion, $tipoUnidad;

	public $tipoUnidades;

	public $open = false;

	protected $rules = [
		'numero' => 'required|numeric',
		'tipoUnidad' => 'required|not_in:0',
		'direccion' => 'required|max:255',
	];
	
	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save() {
		$this->validate();

		Unidad::create([
			'numero' => $this->numero,
			'tipo_unidad_id' => $this->tipoUnidad,
			'direccion' => $this->direccion,
		]);

		$this->reset([
			'open',
			'numero',
			'direccion',
		]);

		$this->emitTo('tabla-unidad', 'render');
		$this->emit('alert', 'La unidad se registró satisfactoriamente');
	}

	public function mount() {
		$this->tipoUnidades = TipoUnidad::all();
	}

    public function render()
    {
        return view('livewire.nueva-unidad');
    }
}
