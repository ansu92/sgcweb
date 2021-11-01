<?php

namespace Database\Seeders;

use App\Models\Banco;
use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		foreach ([
			'100%Banco',
			'Abn Amro Bank',
			'Bancamiga Banco Microfinanciero, C.A.',
			'Banco Activo Banco Comercial, C.A.',
			'Banco AgrÍcola',
			'Banco Bicentenario',
			'Banco Caroní, C.A. Banco Universal',
			'Banco de Desarrollo del Microempresario',
			'Banco de Venezuela S.A.I.C.A.',
			'Banco del Caribe C.A.',
			'Banco del Pueblo Soberano C.A.',
			'Banco del Tesoro',
			'Banco Exterior C.A.',
			'Banco Industrial de Venezuela.',
			'Banco Internacional de Desarrollo, C.A.',
			'Banco Mercantil C.A.',
			'Banco Nacional De Crédito',
			'Banco Occidental de Descuento.',
			'Banco Plaza',
			'Banco Provincial BBVA',
			'Banco Venezolano De Crédito S.A.',
			'Bancrecer S.A. Banco de Desarrollo',
			'Banesco Banco Universal',
			'BANFANB',
			'Bangente',
			'Banplus Banco Comercial C.A',
			'Citibank.',
			'Corp Banca.',
			'DelSur Banco Universal',
			'Fondo Común',
			'Instituto Municipal De Crédito Popular',
			'Sofitasa',
		] as $nombre) {
			Banco::create([
				'nombre' => $nombre,
			]);
		}
	}
}
