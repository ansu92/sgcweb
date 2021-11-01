<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos = [
            [
                'nombre' => 'Jardinería',
                'descripcion' => '',
            ],
            [
                'nombre' => 'Electricidad',
                'descripcion' => 'Servicio eléctrico de las unidades y áreas comunes',
            ],
            [
                'nombre' => 'Agua',
                'descripcion' => 'Agua por tuberías para el edificio',
            ],
            [
                'nombre' => 'Plomería',
                'descripcion' => 'Reparación de tuberías',
            ],
            [
                'nombre' => 'Construcción',
                'descripcion' => '',
            ],
            [
                'nombre' => 'Vigilancia',
                'descripcion' => '',
            ],
            [
                'nombre' => 'Electricista',
                'descripcion' => 'Reparación de instalaciones eléctricas',
            ],
            [
                'nombre' => 'Aseo',
                'descripcion' => '',
            ],
        ];

        foreach ($datos as $item) {
            Servicio::create([
                'nombre' => $item['nombre'],
                'descripcion' => $item['descripcion'],
                'categoria_id' => Categoria::all()->random()->id,
            ]);
        }
    }
}
