<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mensualidad;
use Livewire\Component;

class Administracion extends Component
{
	public $monto;
	public $moneda = 'Bolívar';

	public $openMensualidad = false;

	public $busqueda = '';
	public $orden = 'created_at';
	public $direccion = 'desc';
	public $cantidad = '10';

	protected $rules = [
		'monto' => 'required|numeric|gt:0',
		'moneda' => 'required',
	];

	public function mount()
	{
		$this->monto = Mensualidad::orderBy('created_at', 'desc')->first()->monto;
		$this->moneda = Mensualidad::orderBy('created_at', 'desc')->first()->moneda;
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
				'nombre' => 'Confirmar pagos',
				'ruta' => 'pago.confirmar',
				'imagen' => 'img/iconos/confirmarPagos.png',
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
				'nombre' => 'Aplicar sanciones',
				'ruta' => 'aplicar-sancion.index',
				'imagen' => 'img/iconos/aplicar-sanciones.png',

			],
			[
				'nombre' => 'Lista de usuarios',
				'ruta' => 'admin.usuario.index',
				'imagen' => 'img/iconos/ListaUsuario.png',

			],
			[
				'nombre' => 'Gestionar responsables',
				'ruta' => 'admin.administrador.index',
				'imagen' => 'img/iconos/gestionarResponsable.png',

			],
			[
				'nombre' => 'Gestionar bancos',
				'ruta' => 'banco.index',
				'imagen' => 'img/iconos/banco.png',

			],
			[
				'nombre' => 'Gestionar cuentas',
				'ruta' => 'cuenta.index',
				'imagen' => 'img/iconos/cuentaBanco.png',

			],
			[
				'nombre' => 'Gestionar sanciones',
				'ruta' => 'admin.sancion.index',
				'imagen' => 'img/iconos/gestionar-sanciones.png',
			],
			[
				'nombre' => 'Gestionar categorías',
				'ruta' => 'categoria.index',
				'imagen' => 'img/iconos/gestionar-categorias.png',

			],
			[
				'nombre' => 'Gestionar servicios',
				'ruta' => 'servicio.index',
				'imagen' => 'img/iconos/servicios.png',

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
			[
				'nombre' => 'Gestionar tipos de unidad',
				'ruta' => 'tipo-unidad.index',
				'imagen' => 'img/iconos/gestionarUnidad.png',

			],
		];

		$mensualidades = Mensualidad::where('fecha', 'LIKE', '%' . $this->busqueda . '%')
			->orderBy($this->orden, $this->direccion)
			->paginate($this->cantidad);

		return view('livewire.admin.administracion', compact('mensualidades', 'menu'));
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
}
