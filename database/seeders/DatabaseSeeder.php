<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Asamblea;
use App\Models\Categoria;
use App\Models\Comunicado;
use App\Models\Cuenta;
use App\Models\Enfermedad;
use App\Models\Fondo;
use App\Models\Integrante;
use App\Models\Iva;
use App\Models\Medicamento;
use App\Models\Propietario;
use App\Models\Proveedor;
use App\Models\Sancion;
use App\Models\Servicio;
use App\Models\TipoUnidad;
use App\Models\TipoUsuario;
use App\Models\Unidad;
use App\Models\User;
use Illuminate\Database\Seeder;

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

		$this->call(CondominioSeeder::class);
		$this->call(RoleSeeder::class);
		$this->call(BancoSeeder::class);

		Enfermedad::factory(15)->create();
		Medicamento::factory(15)->create();
		Categoria::factory(7)->create();
		TipoUnidad::factory(5)->create();
		TipoUsuario::factory(5)->create();

		Cuenta::factory(4)
			->has(Fondo::factory())
			->create();

		$this->call(FondoSeeder::class);

		$this->call(ServicioSeeder::class);
		// Servicio::factory(15)->create();
		Proveedor::factory(15)->create();
		Sancion::factory(15)->create();


		foreach (Proveedor::all() as $proveedor) {
			$proveedor->servicios()->attach(Servicio::all()->random(4));
		}

		for ($i = 0; $i < 40; $i++) {
			Unidad::factory()
				->has(Integrante::factory()->count(rand(1, 4)))
				->create();
		}

		foreach (Unidad::all() as $item) {
			$integrante = $item->integrantes->random();

			$propietario = Propietario::factory()
				->create([
					'integrante_id' => $integrante->id,
					'user_id' => User::factory()->create([
						'name' => $integrante->nombre . ' ' . $integrante->apellido
					])->id,
				]);

			$item->propietario()->associate($propietario);
			$item->save();
		}

		Administrador::factory(20)->create();
		Comunicado::factory(40)->create();

		$this->call(UserSeeder::class);

		$integrantes = Integrante::all();

		foreach ($integrantes as $item) {
			$item->enfermedades()->attach(Enfermedad::all()->random(3));
			$item->medicamentos()->attach(Medicamento::all()->random(2));
		}

		Iva::create(['factor' => 12]);

		$asambleas = Asamblea::factory(5)->create();

		foreach ($asambleas as $item) {
			$item->asistentes()->attach(Integrante::has('unidad')->get()->random(rand(24, 30)));
		}
	}
}
