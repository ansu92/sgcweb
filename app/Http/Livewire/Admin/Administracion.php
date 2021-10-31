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
	public $meses;
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
			$this->meses = $interes->meses;
			$this->estado = $interes->estado;
		}
	}

	public function render()
	{
		$menu = [
			[
				'nombre' => 'Lista de unidades',
				'ruta' => 'admin.unidad.index',
				'imagen' => 'img/iconos/lista-unidades.png',
			],
			[
				'nombre' => 'Lista de habitantes',
				'ruta' => 'admin.habitante.index',
				'imagen' => 'img/iconos/lista-habitantes.png',
			],
			[
				'nombre' => 'Pagar gastos',
				'ruta' => 'pago.create',
				'imagen' => 'img/iconos/pagar-gastos.png',
			],
			[
				'nombre' => 'Comunicados',
				'ruta' => 'comunicado.index',
				'imagen' => 'img/iconos/comunicados.png',
			],
			[
				'nombre' => 'Registrar gastos',
				'ruta' => 'gasto.index',
				'imagen' => 'img/iconos/registrar-gastos.png',
			],
			[
				'nombre' => 'Gestionar sanciones',
				'ruta' => 'admin.sancion.index',
				'imagen' => 'img/iconos/gestionar-sanciones.png',
			],
			[
				'nombre' => 'Aplicar sanciones',
				'ruta' => 'aplicar-sancion.index',
				'imagen' => 'img/iconos/aplicar-sanciones.png',

			],
			[
				'nombre' => 'Gestionar categorías',
				'ruta' => 'categoria.index',
				'imagen' => 'img/iconos/gestionar-categorias.png',

			],
			[
				'nombre' => 'Gestionar enfermedades',
				'ruta' => 'enfermedad.index',
				'imagen' => 'img/iconos/gestionar-enfermedades.png',

			],
			[
				'nombre' => 'Gestionar medicamentos',
				'ruta' => 'medicamento.index',
				'imagen' => 'img/iconos/gestionar-medicamentos.png',

			],
		];

		$mensualidades = Mensualidad::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

		$intereses = Interes::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

		return view('livewire.admin.administracion', compact('mensualidades', 'intereses', 'menu'));
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
			'factor' => 'required|numeric|gt:0|lte:5',
			'meses' => 'required|numeric|gt:0',
			'estado' => 'boolean',
		];

		$messages = [
			'factor.gt' => 'El factor debe ser mayor a :value%.',
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
					'meses' => $this->meses,
					'estado' => $this->estado,
				]);
			}
		} else {
			Interes::create([
				'factor' => $this->factor,
				'meses' => $this->meses,
				'estado' => $this->estado,
			]);
		}

		$this->reset('openInteres');

		$this->emit('alert', 'El interés fue actualizado con éxito');
	}
}
