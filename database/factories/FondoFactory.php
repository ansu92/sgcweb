<?php

namespace Database\Factories;

use App\Models\Fondo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FondoFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Fondo::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$moneda = $this->faker->randomElement(['Bolívar', 'Dólar']);

		$saldo = 400 * rand(1, 4);

		// if($moneda == 'Bolívar') {
		// 	$saldo = 600000000 * rand(1, 4);

		// } else if($moneda == 'Dólar') {
		// 	$saldo = 200 * rand(1, 4);
		// }

		return [
			'descripcion' => $this->faker->unique()->word,
			'saldo' => $saldo,
			'moneda' => $moneda,
		];
	}
}
