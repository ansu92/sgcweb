<?php

namespace App\Http\Livewire\Enfermedad;

use App\Models\Enfermedad;
use Livewire\Component;

class NuevaEnfermedad extends Component
{
	public $open = false;

	public $nombre;
	public $descripcion;

	protected $rules = [
		'nombre' => 'required|max:25',
		'descripcion' => 'max:255',
	];

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save()
	{
		$this->validate();

		$enfermedad = Enfermedad::withTrashed()->where('nombre', $this->nombre)->first();

		if ($enfermedad === null) {

			Enfermedad::create([
				'nombre' => $this->nombre,
				'descripcion' => $this->descripcion,
			]);
		} else {
			$enfermedad->restore();

			$enfermedad->nombre = $this->nombre;
			$enfermedad->descripcion = $this->descripcion;

			$enfermedad->save();
		}

		$this->reset('open');

		$this->reset([
			'nombre',
			'descripcion',
		]);

		$this->emitTo('enfermedad.tabla-enfermedad', 'render');
		$this->emit('alert', 'La enfermedad se creó satisfactoriamente');
	}

	public function render()
	{
		return view('livewire.enfermedad.nueva-enfermedad');
	}
}
