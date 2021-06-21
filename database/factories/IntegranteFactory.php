<?php

namespace Database\Factories;

use App\Models\Integrante;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'documento' => $this->faker->randomElement(['V', 'E']) . '-' . $this->faker->numberBetween(1000000, 35000000),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'telefono' => '04'.$this->faker->randomElement(['12', '14', '16', '24', '26']) . $this->faker->unique()->numerify('-#######'),
            'email' => $this->faker->unique()->email(),
            'direccion' => $this->faker->address(),
        ];
    }
}
