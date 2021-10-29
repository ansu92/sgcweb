<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

	protected $fillable = [
		'monto',
		'monto_por_pagar',
		'moneda',
		'tasa_cambio',
		'fecha',
		'unidad_id',
		'facturable_id',
		'facturable_type',
	];

	public function pagar(float $monto)
	{
		$this->monto_por_pagar -= $monto;

		if ($this->monto_por_pagar == 0) {
			$this->estado = 'Pagada';
		}

		$this->save();
	}

	public function items() {
		return $this->hasMany(Item::class);
	}

	public function unidad() {
		return $this->belongsTo(Unidad::class);
	}
}
