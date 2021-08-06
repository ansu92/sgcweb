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

		Permission::create(['name' => 'configuracion'])->assignRole($role1);

		Permission::create(['name' => 'admin.banco.index'])->assignRole($role1);
		Permission::create(['name' => 'admin.banco.create'])->assignRole($role1);
		Permission::create(['name' => 'admin.banco.edit'])->assignRole($role1);
		Permission::create(['name' => 'admin.banco.delete'])->assignRole($role1);

		Permission::create(['name' => 'admin.categoria.index'])->assignRole($role1);
		Permission::create(['name' => 'admin.categoria.create'])->assignRole($role1);
		Permission::create(['name' => 'admin.categoria.edit'])->assignRole($role1);
		Permission::create(['name' => 'admin.categoria.delete'])->assignRole($role1);

		Permission::create(['name' => 'cuenta.index'])->assignRole($role1);
		Permission::create(['name' => 'cuenta.create'])->assignRole($role1);
		Permission::create(['name' => 'cuenta.edit'])->assignRole($role1);
		Permission::create(['name' => 'cuenta.delete'])->assignRole($role1);

		Permission::create(['name' => 'fondo.index'])->assignRole($role1);
		Permission::create(['name' => 'fondo.create'])->assignRole($role1);
		Permission::create(['name' => 'fondo.edit'])->assignRole($role1);
		Permission::create(['name' => 'fondo.delete'])->assignRole($role1);

		Permission::create(['name' => 'proveedor.index'])->assignRole($role1);
		Permission::create(['name' => 'proveedor.create'])->assignRole($role1);
		Permission::create(['name' => 'proveedor.edit'])->assignRole($role1);
		Permission::create(['name' => 'proveedor.delete'])->assignRole($role1);

		Permission::create(['name' => 'admin.servicio.index'])->assignRole($role1);
		Permission::create(['name' => 'admin.servicio.create'])->assignRole($role1);
		Permission::create(['name' => 'admin.servicio.edit'])->assignRole($role1);
		Permission::create(['name' => 'admin.servicio.delete'])->assignRole($role1);

		Permission::create(['name' => 'admin.tipo-unidad.index'])->assignRole($role1);
		Permission::create(['name' => 'admin.tipo-unidad.create'])->assignRole($role1);
		Permission::create(['name' => 'admin.tipo-unidad.edit'])->assignRole($role1);
		Permission::create(['name' => 'admin.tipo-unidad.delete'])->assignRole($role1);

		Permission::create(['name' => 'admin.unidad.index'])->assignRole($role1);
		Permission::create(['name' => 'admin.unidad.create'])->assignRole($role1);
		Permission::create(['name' => 'admin.unidad.edit'])->assignRole($role1);
		Permission::create(['name' => 'admin.unidad.delete'])->assignRole($role1);


		Permission::create(['name' => 'pago.index'])->assignRole($role1);
		Permission::create(['name' => 'pago.create'])->assignRole($role1);

		// Permission::create(['name' => 'tipo-unidad.index'])->assignRole($role1);
		// Permission::create(['name' => 'tipo-unidad.create'])->assignRole($role1);
		// Permission::create(['name' => 'tipo-unidad.edit'])->assignRole($role1);
		// Permission::create(['name' => 'tipo-unidad.delete'])->assignRole($role1);
    }
}
