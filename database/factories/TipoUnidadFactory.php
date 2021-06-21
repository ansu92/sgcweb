<?php

namespace Database\Factories;

use App\Models\TipoUnidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoUnidadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoUnidad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'area' => $this->faker->randomFloat(2, 14, 100),
        ];
    }
}
