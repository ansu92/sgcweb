<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$role1 = Role::create(['name' => 'Administrador']);
		$role2 = Role::create(['name' => 'Propietario']);
		$role3 = Role::create(['name' => 'Portero']);
		$role4 = Role::create(['name' => 'Condominio']);


		Permission::create(['name' => 'home'])->assignRole($role2);

		Permission::create(['name' => 'asamblea.index'])->assignRole($role4);
		Permission::create(['name' => 'asamblea.create'])->assignRole($role4);
		Permission::create(['name' => 'asamblea.show'])->assignRole($role4);

		Permission::create(['name' => 'banco.index']);
		Permission::create(['name' => 'banco.create']);
		Permission::create(['name' => 'banco.edit']);
		Permission::create(['name' => 'banco.delete']);

		Permission::create(['name' => 'categoria.index']);
		Permission::create(['name' => 'categoria.create']);
		Permission::create(['name' => 'categoria.edit']);
		Permission::create(['name' => 'categoria.delete']);

		Permission::create(['name' => 'cuenta.index'])->assignRole($role4);
		Permission::create(['name' => 'cuenta.create'])->assignRole($role4);
		Permission::create(['name' => 'cuenta.edit'])->assignRole($role4);
		Permission::create(['name' => 'cuenta.show'])->assignRole($role4);

		Permission::create(['name' => 'cierre-mes.index'])->assignRole($role4);

		Permission::create(['name' => 'comunicado.index'])->assignRole($role4);
		Permission::create(['name' => 'comunicado.create'])->assignRole($role4);
		Permission::create(['name' => 'comunicado.edit'])->assignRole($role4);
		Permission::create(['name' => 'comunicado.show'])->assignRole($role4);

		Permission::create(['name' => 'fondo.index'])->assignRole($role4);
		Permission::create(['name' => 'fondo.create'])->assignRole($role4);
		Permission::create(['name' => 'fondo.edit'])->assignRole($role4);
		Permission::create(['name' => 'fondo.show'])->assignRole($role4);

		Permission::create(['name' => 'gasto.index'])->assignRole($role4);
		Permission::create(['name' => 'gasto.create'])->assignRole($role4);
		Permission::create(['name' => 'gasto.show'])->assignRole($role4);

		Permission::create(['name' => 'pago-condominio.index'])->assignRole($role4);
		Permission::create(['name' => 'pago-condominio.create'])->assignRole($role4);
		Permission::create(['name' => 'pago-condominio.show'])->assignRole($role4);

		Permission::create(['name' => 'pago-propietario.index'])->assignRole($role2);
		Permission::create(['name' => 'pago-propietario.create'])->assignRole($role2);
		Permission::create(['name' => 'pago-propietario.show'])->assignRole($role2);
		Permission::create(['name' => 'pago-propietario.confirmar'])->assignRole($role4);

		Permission::create(['name' => 'proveedor.index'])->assignRole($role4);
		Permission::create(['name' => 'proveedor.create'])->assignRole($role4);
		Permission::create(['name' => 'proveedor.edit'])->assignRole($role4);
		Permission::create(['name' => 'proveedor.show'])->assignRole($role4);

		Permission::create(['name' => 'servicio.index']);
		Permission::create(['name' => 'servicio.create']);
		Permission::create(['name' => 'servicio.edit']);

		Permission::create(['name' => 'tipo-unidad.index']);
		Permission::create(['name' => 'tipo-unidad.create']);
		Permission::create(['name' => 'tipo-unidad.edit']);
		Permission::create(['name' => 'tipo-unidad.delete']);

		Permission::create(['name' => 'unidad.index'])->assignRole($role2);
		Permission::create(['name' => 'unidad.edit'])->assignRole($role2);
		Permission::create(['name' => 'unidad.show'])->assignRole($role2);

		Permission::create(['name' => 'visita.index'])->assignRole($role3);
		Permission::create(['name' => 'visita.create'])->assignRole($role3);
		Permission::create(['name' => 'visita.show'])->assignRole($role3);

		Permission::create(['name' => 'visita.lista'])->assignRole($role4);


		// Permisos exclusivos de administrador
		Permission::create(['name' => 'admin.home'])->assignRole($role4);

		Permission::create(['name' => 'admin.administrador.index']);
		Permission::create(['name' => 'admin.administrador.create']);
		Permission::create(['name' => 'admin.administrador.delete']);

		Permission::create(['name' => 'admin.comunicado.index']);
		Permission::create(['name' => 'admin.comunicado.delete']);

		Permission::create(['name' => 'admin.unidad.index']);
		Permission::create(['name' => 'admin.unidad.create']);
		Permission::create(['name' => 'admin.unidad.edit']);
		Permission::create(['name' => 'admin.unidad.delete']);

		Permission::create(['name' => 'admin.usuario.index']);
		Permission::create(['name' => 'admin.usuario.create']);
		Permission::create(['name' => 'admin.usuario.edit']);
		Permission::create(['name' => 'admin.usuario.delete']);
		Permission::create(['name' => 'admin.usuario.show']);


		$role1->syncPermissions(Permission::all());
	}
}
