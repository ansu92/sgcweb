<?php

namespace Database\Factories;

use App\Models\Integrante;
use App\Models\Propietario;
use App\Models\TipoUnidad;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Unidad::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'numero' => $this->faker->unique->numerify('####'),
			'direccion' => $this->faker->address,
			'tipo_unidad_id' => TipoUnidad::all()->random()->id,
			'documento' => $this->faker->unique()->numerify('####################'),
		];
	}
}
