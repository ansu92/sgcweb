<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
	use HasFactory;

	/**
	 * Las relaciones que siempre deberían cargarse.
	 *
	 * @var array
	 */
	protected $with = ['integrante'];

	public function integrante()
	{
		return $this->belongsTo(Integrante::class);
	}

	public function unidades()
	{
		return $this->hasMany(Unidad::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function facturas() {
		return $this->hasManyThrough(Factura::class, Unidad::class);
	}
}
