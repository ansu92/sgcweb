<?php

namespace Database\Factories;

use App\Models\Banco;
use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuentaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cuenta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero' => $this->faker->unique()->numerify('####################'),
            'tipo' => $this->faker->randomElement(['Corriente', 'Ahorro']),
            'beneficiario' => 'Condominio',
            'documento' => $this->faker->numerify('V-########-#'),
            'banco_id' => Banco::all('id')->random(),
            'telefono' => '04'.$this->faker->randomElement(['12', '14', '16', '24', '26']) . $this->faker->unique()->numerify('-#######'),
            'publica' => $this->faker->randomElement([true, false]),
        ];
    }
}
