<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
	use HasFactory;

	protected $fillable = ['descripcion', 'saldo', 'moneda', 'cuenta_id'];

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
