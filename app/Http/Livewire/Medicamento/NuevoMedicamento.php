<?php

namespace App\Http\Livewire\Medicamento;

use App\Models\Medicamento;
use Livewire\Component;

class NuevoMedicamento extends Component
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

		$medicamento = Medicamento::withTrashed()->where('nombre', $this->nombre)->first();

		if ($medicamento === null) {

			Medicamento::create([
				'nombre' => $this->nombre,
				'descripcion' => $this->descripcion,
			]);
		} else {
			$medicamento->restore();

			$medicamento->nombre = $this->nombre;
			$medicamento->descripcion = $this->descripcion;

			$medicamento->save();
		}

		$this->reset('open');

		$this->reset([
			'nombre',
			'descripcion',
		]);

		$this->emitTo('medicamento.tabla-medicamento', 'render');
		$this->emit('alert', 'El medicamento se creó satisfactoriamente');
	}

	public function render()
	{
		return view('livewire.medicamento.nuevo-medicamento');
	}
}
