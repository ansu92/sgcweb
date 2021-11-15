<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Integrante;
use App\Models\Propietario;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$integrante = Integrante::factory([
			'letra' => 'V',
			'documento' => '26942316',
			'nombre' => 'Diego',
			's_nombre' => 'A.',
			'apellido' => 'Rodríguez',
			'fecha_nacimiento' => '25-08-1999',
			'email' => 'diegordgz8@outlook.com',
		])->create();

		$usuario = User::factory([
			'name' => 'Diego A. Rodríguez',
			'email' => 'diegordgz8@outlook.com',
			'password' => bcrypt('645362'),
		])->create()->assignRole('Administrador');

		$propietario = Propietario::factory()->create([
			'integrante_id' => $integrante->id,
			'user_id' => $usuario->id,
		]);

		Administrador::create([
			'integrante_id' => $integrante->id,
			'rol' => 'Master',
			'user_id' => $usuario->id,
		]);

		$unidad = Unidad::factory()->create();
		$unidad->propietario()->associate($propietario)->save();
		$integrante->unidad()->associate($unidad)->save();


		$integrante = Integrante::factory([
			'nombre' => 'Anthony',
			'apellido' => 'Suárez',
			'fecha_nacimiento' => '08-09-1992',
			'email' => 'ajhensuarez@gmail.com',
		])->create();

		$usuario = User::factory([
			'name' => 'Anthony Suárez',
			'email' => 'ajhensuarez@gmail.com',
			'password' => bcrypt('22318939'),
		])->create()->assignRole('Administrador');

		$propietario = Propietario::factory()->create([
			'integrante_id' => $integrante->id,
			'user_id' => $usuario->id,
		]);

		Administrador::create([
			'integrante_id' => $integrante->id,
			'rol' => 'Master',
			'user_id' => $usuario->id,
		]);

		$unidad = Unidad::factory()->create();
		$unidad->propietario()->associate($propietario)->save();
		$integrante->unidad()->associate($unidad)->save();


		// Usuario con rol de Administrador
		$integrante = Integrante::factory([
			'letra' => 'V',
			'documento' => '00000000',
			'nombre' => 'Admin',
			'apellido' => 'Istrador',
			'fecha_nacimiento' => '01-01-2000',
			'email' => 'teamsgcweb2.0@gmail.com',
		])->create();

		$usuario = User::factory([
			'name' => 'AdminIstrador',
			'email' => 'teamsgcweb2.0@gmail.com',
			'password' => bcrypt('admin'),
		])->create()->assignRole('Administrador');

		$propietario = Propietario::factory()->create([
			'integrante_id' => $integrante->id,
			'user_id' => $usuario->id,
		]);

		Administrador::create([
			'integrante_id' => $integrante->id,
			'rol' => 'Administrador',
			'user_id' => $usuario->id,
		]);

		$unidad = Unidad::factory()->create();
		$unidad->propietario()->associate($propietario)->save();
		$integrante->unidad()->associate($unidad)->save();


		// Usuario con rol de Propietario
		$integrante = Integrante::factory([
			'letra' => 'V',
			'documento' => '00000001',
			'nombre' => 'Pro',
			'apellido' => 'Pietario',
			'fecha_nacimiento' => '01-01-2000',
			'email' => 'propietario@gmail.com',
		])->create();

		$usuario = User::factory([
			'name' => 'ProPietario',
			'email' => 'propietario@gmail.com',
			'password' => bcrypt('1234'),
		])->create()->assignRole('Propietario');

		$propietario = Propietario::factory()->create([
			'integrante_id' => $integrante->id,
			'user_id' => $usuario->id,
		]);

		$unidad = Unidad::factory()->create();
		$unidad->propietario()->associate($propietario)->save();
		$integrante->unidad()->associate($unidad)->save();


		// Usuario con rol de Condominio
		$integrante = Integrante::factory([
			'letra' => 'V',
			'documento' => '00000002',
			'nombre' => 'Condo',
			'apellido' => 'Minio',
			'fecha_nacimiento' => '01-01-2000',
			'email' => 'condominio@gmail.com',
		])->create();

		$usuario = User::factory([
			'name' => 'CondoMinio',
			'email' => 'condominio@gmail.com',
			'password' => bcrypt('1234'),
		])->create()->assignRole('Condominio');

		Administrador::create([
			'integrante_id' => $integrante->id,
			'rol' => 'Administrador',
			'user_id' => $usuario->id,
		]);


		// Usuario con rol de Portero
		$integrante = Integrante::factory([
			'letra' => 'V',
			'documento' => '00000003',
			'nombre' => 'Por',
			'apellido' => 'Tero',
			'fecha_nacimiento' => '01-01-2000',
			'email' => 'portero@gmail.com',
		])->create();

		$usuario = User::factory([
			'name' => 'PorTero',
			'email' => 'portero@gmail.com',
			'password' => bcrypt('1234'),
		])->create()->assignRole('Portero');

		Administrador::create([
			'integrante_id' => $integrante->id,
			'rol' => 'Administrador',
			'user_id' => $usuario->id,
		]);
	}
}
