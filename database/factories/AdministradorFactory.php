<?php

namespace Database\Factories;

use App\Models\Administrador;
use App\Models\Integrante;
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
        return [
            'integrante_id' => $this->faker->unique()->randomElement(Integrante::all('id')),
        ];
    }
}
