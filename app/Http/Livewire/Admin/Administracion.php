<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Administracion extends Component
{
	public function render()
	{
		$menu = [
			[
				'nombre' => 'Lista de unidades',
				'ruta' => 'admin.unidad.index',
				'imagen' => 'img/iconos/lista-unidades.png',
				'can' => 'admin.unidad.index',
			],
			[
				'nombre' => 'Lista de habitantes',
				'ruta' => 'admin.habitante.index',
				'imagen' => 'img/iconos/lista-habitantes.png',
				'can' => 'integrante.index',
			],
			[
				'nombre' => 'Confirmar pagos',
				'ruta' => 'pago.confirmar',
				'imagen' => 'img/iconos/confirmarPagos.png',
				'can' => 'pago-propietario.confirmar',
			],
			[
				'nombre' => 'Pagar gastos',
				'ruta' => 'pago.create',
				'imagen' => 'img/iconos/pagar-gastos.png',
				'can' => 'pago-condominio.create',
			],
			[
				'nombre' => 'Comunicados',
				'ruta' => 'comunicado.index',
				'imagen' => 'img/iconos/comunicados.png',
				'can' => 'comunicado.index',
			],
			[
				'nombre' => 'Registrar gastos',
				'ruta' => 'gasto.index',
				'imagen' => 'img/iconos/registrar-gastos.png',
				'can' => 'gasto.index',
			],
			[
				'nombre' => 'Aplicar sanciones',
				'ruta' => 'aplicar-sancion.index',
				'imagen' => 'img/iconos/aplicar-sanciones.png',
				'can' => 'sancion.aplicar',
			],
			[
				'nombre' => 'Lista de usuarios',
				'ruta' => 'admin.usuario.index',
				'imagen' => 'img/iconos/ListaUsuario.png',
				'can' => 'admin.usuario.index',
			],
			[
				'nombre' => 'Gestionar responsables',
				'ruta' => 'admin.administrador.index',
				'imagen' => 'img/iconos/gestionarResponsable.png',
				'can' => 'admin.administrador.index',
			],
			[
				'nombre' => 'Gestionar bancos',
				'ruta' => 'banco.index',
				'imagen' => 'img/iconos/banco.png',
				'can' => 'banco.index',
			],
			[
				'nombre' => 'Gestionar cuentas',
				'ruta' => 'cuenta.index',
				'imagen' => 'img/iconos/cuentaBanco.png',
				'can' => 'cuenta.index',
			],
			[
				'nombre' => 'Gestionar sanciones',
				'ruta' => 'admin.sancion.index',
				'imagen' => 'img/iconos/gestionar-sanciones.png',
				'can' => 'sancion.index',
			],
			[
				'nombre' => 'Gestionar categorías',
				'ruta' => 'categoria.index',
				'imagen' => 'img/iconos/gestionar-categorias.png',
				'can' => 'categoria.index',
			],
			[
				'nombre' => 'Gestionar servicios',
				'ruta' => 'servicio.index',
				'imagen' => 'img/iconos/servicios.png',
				'can' => 'servicio.index',
			],
			[
				'nombre' => 'Gestionar enfermedades',
				'ruta' => 'enfermedad.index',
				'imagen' => 'img/iconos/gestionar-enfermedades.png',
				'can' => 'enfermedad.index',
			],
			[
				'nombre' => 'Gestionar medicamentos',
				'ruta' => 'medicamento.index',
				'imagen' => 'img/iconos/gestionar-medicamentos.png',
				'can' => 'medicamento.index',
			],
			[
				'nombre' => 'Gestionar tipos de unidad',
				'ruta' => 'admin.backup',
				'imagen' => 'img/iconos/gestionarUnidad.png',
				'can' => 'tipo-unidad.index',
			],
			[
				'nombre' => 'Recuperación de base de datos',
				'ruta' => 'tipo-unidad.index',
				'imagen' => 'img/iconos/base-datos.png',
				'can' => 'admin.database',
			],
		];

		return view('livewire.admin.administracion', compact('menu'));
	}
}
