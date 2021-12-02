<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

	protected $fillable = [
		'numero',
		'monto',
		'monto_por_pagar',
		'moneda',
		'fecha',
		'unidad_id',
		'iva_id',
		'interes_id',
		'tasa_cambio_id',
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

	public function iva() {
		return $this->belongsTo(Iva::class);
	}

	public function interes() {
		return $this->belongsTo(Interes::class);
	}

	public function tasa() {
		return $this->belongsTo(TasaCambio::class);
	}
}
