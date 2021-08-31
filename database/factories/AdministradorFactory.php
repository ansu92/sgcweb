<?php

namespace Database\Factories;

use App\Models\Administrador;
use App\Models\Integrante;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministradorFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Administrador::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$persona = Integrante::all()->random();

		return [
			'integrante_id' => $persona->id,
			'rol' => $this->faker->jobTitle,
			'user_id' => User::factory(['name' => $persona->nombre . ' ' . $persona->apellido]),
		];
	}
}
