<?php

namespace Database\Factories;

use App\Models\Enfermedad;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnfermedadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enfermedad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->word,
            'descripcion' => $this->faker->sentence,
        ];
    }
}
