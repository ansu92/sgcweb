<?php

namespace Database\Seeders;

use App\Models\Integrante;
use App\Models\Propietario;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
			'nombre' => 'Diego',
			's_nombre' => 'A.',
			'apellido' => 'Rodríguez',
			'email' => 'diegordgz8@outlook.com',
		])->create();

		$usuario = User::factory([
			'name' => 'Diego A. Rodríguez',
			'email' => 'diegordgz8@outlook.com',
			'password' => bcrypt('645362'),
		])->create()->assignRole('Administrador');

		$propietario = Propietario::create([
			'integrante_id' => $integrante->id,
			'user_id' => $usuario->id,
		]);

		Unidad::factory()->create()->propietario()->associate($propietario)->save();

		$integrante = Integrante::factory([
			'nombre' => 'Anthony',
			'apellido' => 'Jhen',
			'email' => 'ajhensuarez@gmail.com',
		])->create();

		$usuario = User::factory([
			'name' => 'Anthony Jhen',
			'email' => 'ajhensuarez@gmail.com',
			'password' => bcrypt('password'),
		])->create()->assignRole('Administrador');

		$propietario = Propietario::create([
			'integrante_id' => $integrante->id,
			'user_id' => $usuario->id,
		]);

		Unidad::factory()->create()->propietario()->associate($propietario)->save();
	}
}
