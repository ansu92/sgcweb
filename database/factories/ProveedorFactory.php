<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProveedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proveedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'letra' => $this->faker->randomElement(['V', 'E', 'J']),
            'documento' =>$this->faker->unique()->numberBetween(1000000, 35000000),
            'nombre' => $this->faker->unique()->company(),
            'contacto' => $this->faker->name(),
            'telefono' => '04'.$this->faker->randomElement(['12', '14', '16', '24', '26']) . $this->faker->unique()->numerify('-#######'),
            'email' => $this->faker->unique()->email(),
            'direccion' => $this->faker->address(),
        ];
    }
}
