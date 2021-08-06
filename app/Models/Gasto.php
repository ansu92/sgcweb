<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

	protected $fillable = [
		'descripcion',
		'calculo_por',
		'mes_cobro',
		'moneda',
		'monto',
		'saldo',
		'observaciones',
		'factura',
		'proveedor_id',
	];

	public function proveedor() {
		return $this->belongsTo(Proveedor::class);
	}

	public function extraordinario() {
		return $this->hasOne(GastoExtraordinario::class);
	}

    public function servicios() {
        return $this->belongsToMany(Servicio::class)->withPivot('monto')->withTimestamps();
    }
}
