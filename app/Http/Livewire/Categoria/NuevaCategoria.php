<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;

class NuevaCategoria extends Component
{
	public $abierto = false;

	public $nombre, $descripcion;

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

		Categoria::create([
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
		]);

		$this->reset([
			'abierto',
			'nombre',
			'descripcion',
		]);

		$this->emitTo('categoria.tabla-categoria', 'render');
		$this->emit('alert', 'La categoría se creó satisfactoriamente');
	}

	public function render()
	{
		return view('livewire.categoria.nueva-categoria');
	}
}
