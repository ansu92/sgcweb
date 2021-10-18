<?php

namespace Database\Factories;

use App\Models\Integrante;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class IntegranteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Integrante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'letra' => $this->faker->randomElement(['V', 'E']),
            'documento' => $this->faker->unique()->numberBetween(1000000, 35000000),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-70 years', '-6 months'),
            'telefono' => '04'.$this->faker->randomElement(['12', '14', '16', '24', '26']) . $this->faker->unique()->numerify('-#######'),
            'email' => $this->faker->unique()->email(),
        ];
    }
}
