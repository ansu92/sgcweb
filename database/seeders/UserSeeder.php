<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::create([
			'name' => 'Diego A. Rodríguez',
			'email' => 'diegordgz8@outlook.com',
			'email_verified_at' => now(),
			'password' => bcrypt('645362'),
			'remember_token' => Str::random(10),
		])->assignRole('Administrador');

		User::create([
			'name' => 'Anthony Jhen',
			'email' => 'ajhensuarez@gmail.com',
			'email_verified_at' => now(),
			'password' => bcrypt('password'),
			'remember_token' => Str::random(10),
		])->assignRole('Administrador');
    }
}
