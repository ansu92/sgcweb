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
        $nombre = $this->faker->unique()->company();

        return [
            'documento' => $this->faker->randomElement(['V', 'E', 'J']) . '-' . $this->faker->unique()->numberBetween(1000000, 35000000),
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'contacto' => $this->faker->name(),
            'telefono' => '04'.$this->faker->randomElement(['12', '14', '16', '24', '26']) . $this->faker->unique()->numerify('-#######'),
            'email' => $this->faker->unique()->email(),
            'direccion' => $this->faker->address(),
        ];
    }
}
