<?php

namespace Database\Seeders;

use App\Models\Banco;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Banco::factory(10)->create();
        Proveedor::factory(10)->create();
    }
}
