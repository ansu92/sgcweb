<?php

namespace App\Http\Livewire\Comunicado;

use App\Models\Comunicado;
use Livewire\Component;

class NuevoComunicado extends Component
{
	public $open = false;

	public $asunto, $contenido;

	protected $rules = [
		'asunto' => 'required|max:45',
		'contenido' => 'required',
	];

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save()
	{
		$this->validate();

		Comunicado::create([
			'asunto' => $this->asunto,
			'contenido' => $this->contenido,
		]);

		$this->reset([
			'open',
			'asunto',
			'contenido',
		]);

		$this->emitTo('comunicado.tabla-comunicado', 'render');
		$this->emit('alert', 'El comunicado se creó satisfactoriamente');
	}

	public function render()
	{
        return view('livewire.comunicado.nuevo-comunicado');
    }
}
