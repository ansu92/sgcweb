<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
    use HasFactory;

	protected $fillable = ['descripcion', 'saldo', 'moneda'];

	public function cuenta() {
		return $this->belongsTo(Cuenta::class);
	}
}
