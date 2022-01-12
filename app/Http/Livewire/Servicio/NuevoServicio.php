<?php

namespace App\Http\Livewire\Servicio;

use App\Models\Categoria;
use App\Models\Servicio;
use Livewire\Component;

class NuevoServicio extends Component
{
	public $open = false;

	public $nombre, $descripcion, $categoria;

	protected $rules = [
		'nombre' => 'required|max:60|unique:servicios,nombre,NULL,NULL,deleted_at,NULL',
		'descripcion' => 'nullable',
		'categoria' => 'required|not_in:0',
	];

	public function render()
	{
		$categorias = Categoria::all();

		return view('livewire.servicio.nuevo-servicio', compact('categorias'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function save()
	{
		$this->validate();

		$servicio = Servicio::withTrashed()->where('nombre', $this->nombre)->first();

		if ($servicio === null) {

			Servicio::create([
				'nombre' => $this->nombre,
				'descripcion' => $this->descripcion,
				'categoria_id' => $this->categoria,
			]);
		} else {
			$servicio->restore();

			$servicio->nombre = $this->nombre;
			$servicio->descripcion = $this->descripcion;
			$servicio->categoria_id = $this->categoria;

			$servicio->save();
		}

		$this->reset([
			'open',
			'nombre',
			'descripcion',
			'categoria',
		]);

		$this->emitTo('servicio.tabla-servicio', 'render');
		toastr()->livewire()->addSuccess('El servicio se creó satisfactoriamente');
	}
}
