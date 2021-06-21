<?php

namespace Database\Factories;

use App\Models\Propietario;
use App\Models\TipoUnidad;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unidad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero' => $this->faker->numerify('####################'),
            'direccion' => $this->faker->address,
            'propietario_id' => $this->faker->unique()->randomElement(Propietario::all('id')),
            'tipo_unidad_id' => $this->faker->randomElement(TipoUnidad::all('id')),
        ];
    }
}
