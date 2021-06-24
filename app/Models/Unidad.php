<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';

	public function integrantes() {
		return $this->hasMany(Integrante::class);
	}

    public function visitas() {
        return $this->hasMany(Visita::class);
    }

    public function tipoUnidad() {
        return $this->belongsTo(TipoUnidad::class);
    }

    public function propietario() {
        return $this->belongsTo(Propietario::class);
    }
}
