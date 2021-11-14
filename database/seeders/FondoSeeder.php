<?php

namespace Database\Seeders;

use App\Models\Fondo;
use Illuminate\Database\Seeder;

class FondoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fondo en efectivo en bolívares
        Fondo::create([
            'descripcion' => 'Efectivo en bolívares',
            'saldo' => 2000,
            'moneda' => 'Bolívar',
        ]);

        // Fondo en efectivo en dólares
        Fondo::create([
            'descripcion' => 'Efectivo en dólares',
            'saldo' => 1000,
            'moneda' => 'Dólar',
        ]);
    }
}
