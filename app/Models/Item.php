<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use HasFactory;

	protected $fillable = [
		'itemable_id',
		'itemable_type',
		'monto',
		'fecha',
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function itemable() {
		return $this->morphTo();
	}

	public function convertirMonto($moneda, $tasa)
	{
		if ($this->itemable->moneda != $moneda) {

			if ($this->itemable->moneda == 'Bolívar') {
				$montoConvertido = $this->monto / $tasa;

			} else if ($this->itemable->moneda == 'Dólar') {
				$montoConvertido = $this->monto * $tasa;
			}

			$this->monto = $montoConvertido;
		}
	}
}
