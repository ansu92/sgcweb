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


		Permission::create(['name' => 'banco.index']);
		Permission::create(['name' => 'banco.create']);
		Permission::create(['name' => 'banco.edit']);
		Permission::create(['name' => 'banco.delete']);

		Permission::create(['name' => 'categoria.index']);
		Permission::create(['name' => 'categoria.create']);
		Permission::create(['name' => 'categoria.edit']);
		Permission::create(['name' => 'categoria.delete']);

		Permission::create(['name' => 'cuenta.index']);
		Permission::create(['name' => 'cuenta.create']);
		Permission::create(['name' => 'cuenta.edit']);
		Permission::create(['name' => 'cuenta.show']);

		Permission::create(['name' => 'comunicado.index']);
		Permission::create(['name' => 'comunicado.create']);
		Permission::create(['name' => 'comunicado.edit']);
		Permission::create(['name' => 'comunicado.show']);

		Permission::create(['name' => 'fondo.index']);
		Permission::create(['name' => 'fondo.create']);
		Permission::create(['name' => 'fondo.edit']);
		Permission::create(['name' => 'fondo.show']);

		Permission::create(['name' => 'pago.index']);
		Permission::create(['name' => 'pago.create']);
		Permission::create(['name' => 'pago.show']);

		Permission::create(['name' => 'proveedor.index']);
		Permission::create(['name' => 'proveedor.create']);
		Permission::create(['name' => 'proveedor.edit']);
		Permission::create(['name' => 'proveedor.show']);

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


		// Permisos exclusivos de administrador
		Permission::create(['name' => 'admin.configuracion']);

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


		$role1->syncPermissions(Permission::all());
	}
}
