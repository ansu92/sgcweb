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
		'fecha',
		'unidad_id',
		'gasto_id',
	];

	public function gasto() {
		$this->belongsTo(Gasto::class);
	}

	public function unidad() {
		return $this->belongsTo(Unidad::class);
	}
}
