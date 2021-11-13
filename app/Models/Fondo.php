<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fondo extends Model
{
	use HasFactory;

	protected $fillable = ['descripcion', 'saldo', 'moneda', 'cuenta_id'];

	public function getMovimientos()
	{
		$egresos = DB::table('pagos_gastos')
			->join('fondos', 'pagos_gastos.fondo_id', '=', 'fondos.id')
			->select(['monto', 'fecha', 'pagos_gastos.descripcion'])
			->get();

		$ingresos = DB::table('pagos_propietario')
			->join('fondos', 'pagos_propietario.cuenta_id', '=', 'fondos.cuenta_id')
			->select(['monto', 'fecha', 'pagos_propietario.descripcion'])
			->get();

		$movimientos = $egresos->merge($ingresos);

		return $egresos;
		return $movimientos;
	}

	public function acreditar(float $monto)
	{
		$this->saldo += $monto;
		$this->save();
	}

	public function debitar(float $monto)
	{
		$this->saldo -= $monto;
		$this->save();
	}

	public function cuenta()
	{
		return $this->belongsTo(Cuenta::class);
	}

	public function pagos()
	{
		return $this->hasMany(Pago::class);
	}
}
