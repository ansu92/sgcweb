<?php

namespace App\Http\Livewire\Admin;

use App\Models\Interes;
use App\Models\Mensualidad;
use Livewire\Component;

class Administracion extends Component
{
	public $monto;
	public $moneda = 'Bolívar';

	public $factor;
	public $estado = false;

	public $openMensualidad = false;
	public $openInteres = false;

	public $orden = 'created_at';
	public $cantidad = 10;
	public $busqueda = '';
	public $direccion = 'desc';

	protected $rules = [
		'monto' => 'required|numeric|gt:0',
		'moneda' => 'required',
	];

	public function mount()
	{
		$this->monto = Mensualidad::orderBy('created_at', 'desc')->first()->monto;
		$this->moneda = Mensualidad::orderBy('created_at', 'desc')->first()->moneda;

		$interes = Interes::orderBy('created_at', 'desc')->first();

		if ($interes) {
			$this->factor = $interes->factor;
			$this->estado = $interes->estado;
		}
	}

	public function render()
	{
		$mensualidades = Mensualidad::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

		$intereses = Interes::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

		return view('livewire.admin.administracion', compact('mensualidades', 'intereses'));
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function actualizar()
	{
		$this->validate();

		Mensualidad::create([
			'monto' => $this->monto,
			'moneda' => $this->moneda,
		]);

		$this->reset('openMensualidad');

		$this->monto = Mensualidad::orderBy('created_at', 'desc')->first()->monto;
		$this->moneda = Mensualidad::orderBy('created_at', 'desc')->first()->moneda;

		$this->emit('alert', 'La mensaulidad fue actualizada con éxito');
	}

	public function actualizarInteres()
	{
		$rules = [
			'factor' => 'required|numeric|lte:5',
			'estado' => 'boolean',
		];

		$messages = [
			'factor.lte' => 'El factor no puede ser mayor a :value%.',
		];

		$this->validate($rules, $messages);

		$interesActual = Interes::orderBy('created_at', 'desc')->first();

		if ($interesActual) {

			if ($interesActual->factor == $this->factor) {

				if ($interesActual->estado != $this->estado) {
					$interesActual->estado = $this->estado;
					$interesActual->save();
				}
			} else {
				Interes::create([
					'factor' => $this->factor,
					'estado' => $this->estado,
				]);
			}
		} else {
			Interes::create([
				'factor' => $this->factor,
				'estado' => $this->estado,
			]);
		}

		$this->reset('openInteres');

		$this->emit('alert', 'El interés fue actualizado con éxito');
	}
}
