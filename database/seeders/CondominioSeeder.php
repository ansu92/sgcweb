<?php

namespace Database\Seeders;

use App\Models\Condominio;
use App\Models\Mensualidad;
use App\Models\TasaCambio;
use Illuminate\Database\Seeder;

class CondominioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condominio::create([
            'rif' => 'J-12345678',
            'nombre' => 'Condominio Bloque 13',
            'direccion' => 'Bloque 13, Urbanización "Las Acequias", Municipio Cocorote',
        ]);

        Mensualidad::create([
            'monto' => 20,
            'moneda' => 'Dólar',
        ]);

        TasaCambio::create([
            'tasa' => 4.8,
        ]);
    }
}
