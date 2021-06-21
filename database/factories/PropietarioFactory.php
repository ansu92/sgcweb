<?php

namespace Database\Factories;

use App\Models\Integrante;
use App\Models\Propietario;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropietarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Propietario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'integrante_id' => Integrante::factory(),
        ];
    }
}
