<?php

namespace Database\Factories;

use App\Models\Asamblea;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsambleaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asamblea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcion' => $this->faker->words(3, true),
            'fecha' => $this->faker->date(),
        ];
    }
}
