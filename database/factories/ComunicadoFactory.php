<?php

namespace Database\Factories;

use App\Models\Comunicado;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComunicadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comunicado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'asunto' => $this->faker->unique()->realText(45),
			'contenido' => $this->faker->realText(),
        ];
    }
}
