<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Banco;
use App\Models\Categoria;
use App\Models\Cuenta;
use App\Models\Integrante;
use App\Models\Propietario;
use App\Models\Proveedor;
use App\Models\Servicio;
use App\Models\TipoUnidad;
use App\Models\TipoUsuario;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();

		User::create([
			'name' => 'Diego A. Rodríguez',
			'email' => 'diegordgz8@outlook.com',
			'email_verified_at' => now(),
			'password' => bcrypt('645362'),
			'remember_token' => Str::random(10),
		]);

		User::create([
			'name' => 'Anthony Jhen',
			'email' => 'ajhensuarez@gmail.com',
			'email_verified_at' => now(),
			'password' => bcrypt('password'),
			'remember_token' => Str::random(10),
		]);

		$this->call(BancoSeeder::class);
	
		Banco::factory(6)->create();
		Categoria::factory(7)->create();
		TipoUnidad::factory(5)->create();
		TipoUsuario::factory(5)->create();

		Cuenta::factory(4)->create();

		Servicio::factory(15)
			->has(Proveedor::factory()->count(3), 'proveedores')
			->count(10)
			->create();

		for ($i = 0; $i < 40; $i++) {
			Unidad::factory()
				->has(Integrante::factory()->count(rand(1, 4)))
				->create();
		}

		foreach (Unidad::all() as $item) {
			$integrante = $item->integrantes->random();

			$propietario = Propietario::factory()->create([
				'integrante_id' => $integrante->id,
			]);

			$item->propietario()->associate($propietario);
			$item->save();
		}
	}
}
