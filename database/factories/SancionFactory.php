<?php

namespace Database\Factories;

use App\Models\Sancion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SancionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sancion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcion' => $this->faker->unique()->word,
            'monto' => $this->faker->randomFloat(2, 1, 10),
            'moneda'=> $this->faker->randomElement(['Bolívar', 'Dólar']),
        ];
    }
}
