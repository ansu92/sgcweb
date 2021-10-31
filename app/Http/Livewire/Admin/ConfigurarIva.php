<?php

namespace App\Http\Livewire\Admin;

use App\Models\Iva;
use Livewire\Component;

class ConfigurarIva extends Component
{
	public $open = false;

	public $factor;

	public $busqueda = '';
	public $cantidad = '10';
	public $orden = 'created_at';
	public $direccion = 'desc';

	protected $rules = [
		'factor' => 'required|numeric|gt:0'
	];

	public function render()
	{
		$this->factor = Iva::orderBy('created_at', 'desc')->first()->factor;

		$ivas = Iva::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

		return view('livewire.admin.configurar-iva', compact('ivas'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function actualizar()
	{
		$this->validate();

		$ivaActual = Iva::orderBy('created_at', 'desc')->first();

		if ($ivaActual) {

			if ($ivaActual->factor != $this->factor) {

				iva::create([
					'factor' => $this->factor,
				]);
			}
		} else {
			iva::create([
				'factor' => $this->factor,
			]);
		}

		$this->reset('open');

		$this->emit('alert', 'El IVA fue actualizado con éxito');
	}
}
