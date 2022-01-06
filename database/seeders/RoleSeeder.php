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
		Permission::create(['name' => 'admin.home'])->assignRole($role4);

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

		Permission::create(['name' => 'enfermedad.index']);
		Permission::create(['name' => 'enfermedad.show']);
		Permission::create(['name' => 'enfermedad.create']);
		Permission::create(['name' => 'enfermedad.edit']);
		Permission::create(['name' => 'enfermedad.delete']);

		Permission::create(['name' => 'fondo.index'])->assignRole($role4);
		Permission::create(['name' => 'fondo.create'])->assignRole($role4);
		Permission::create(['name' => 'fondo.edit'])->assignRole($role4);
		Permission::create(['name' => 'fondo.show'])->assignRole($role4);

		Permission::create(['name' => 'gasto.index'])->assignRole($role4);
		Permission::create(['name' => 'gasto.create'])->assignRole($role4);
		Permission::create(['name' => 'gasto.show'])->assignRole($role4);

		Permission::create(['name' => 'integrante.index'])->assignRole($role4);
		Permission::create(['name' => 'integrante.show'])->assignRole([$role4, $role2]);

		Permission::create(['name' => 'medicamento.index']);
		Permission::create(['name' => 'medicamento.show']);
		Permission::create(['name' => 'medicamento.create']);
		Permission::create(['name' => 'medicamento.edit']);
		Permission::create(['name' => 'medicamento.delete']);

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

		Permission::create(['name' => 'sancion.index']);
		Permission::create(['name' => 'sancion.create']);
		Permission::create(['name' => 'sancion.edit']);
		Permission::create(['name' => 'sancion.aplicar']);

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

		Permission::create(['name' => 'admin.administrador.index']);
		Permission::create(['name' => 'admin.administrador.create']);
		Permission::create(['name' => 'admin.administrador.delete']);

		Permission::create(['name' => 'admin.comunicado.index']);
		Permission::create(['name' => 'admin.comunicado.delete']);

		Permission::create(['name' => 'admin.unidad.index'])->assignRole($role4);
		Permission::create(['name' => 'admin.unidad.create'])->assignRole($role4);
		Permission::create(['name' => 'admin.unidad.edit'])->assignRole($role4);
		Permission::create(['name' => 'admin.unidad.delete'])->assignRole($role4);

		Permission::create(['name' => 'admin.usuario.index']);
		Permission::create(['name' => 'admin.usuario.create']);
		Permission::create(['name' => 'admin.usuario.edit']);
		Permission::create(['name' => 'admin.usuario.delete']);
		Permission::create(['name' => 'admin.usuario.show']);

		Permission::create(['name' => 'admin.rol.index']);
		Permission::create(['name' => 'admin.rol.create']);
		Permission::create(['name' => 'admin.rol.edit']);
		Permission::create(['name' => 'admin.rol.delete']);
		// Permission::create(['name' => 'admin.rol.show']);

		Permission::create(['name' => 'admin.permiso.index']);
		Permission::create(['name' => 'admin.permiso.create']);
		Permission::create(['name' => 'admin.permiso.edit']);
		Permission::create(['name' => 'admin.permiso.delete']);


		Permission::create(['name' => 'admin.database']);
		Permission::create(['name' => 'admin.database.backup']);
		Permission::create(['name' => 'admin.database.restore']);


		$role1->syncPermissions(Permission::all());
	}
}
