<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Gasto extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'descripcion',
		'tipo',
		'calculo_por',
		'mes_cobro',
		'moneda',
		'monto',
		'saldo',
		'observaciones',
		'factura',
		'proveedor_id',
	];

	public function pagar(float $monto)
	{
		$this->saldo -= $monto;

		if ($this->saldo == 0) {
			$this->estado_pago = 'Pagado';
		}

		$this->save();
	}

	public function getFechaFin()
	{
		$anoFin = Str::substr($this->mes_cobro, 0, 4);
		$mesFin = (int)Str::substr($this->mes_cobro, 5, 2) + $this->extraordinario->num_meses;

		while ($mesFin > 12) {
			$mesFin -= 12;
			$anoFin++;
		}

		$fechaFin = $anoFin . '-' . $mesFin;

		return $fechaFin;
	}

	public function proveedor()
	{
		return $this->belongsTo(Proveedor::class);
	}

	public function extraordinario()
	{
		return $this->hasOne(GastoExtraordinario::class);
	}

	public function servicios()
	{
		return $this->belongsToMany(Servicio::class)->withPivot('monto')->withTimestamps();
	}

	public function factura()
	{
		return $this->morphOne(Factura::class, 'facturable');
	}
}
