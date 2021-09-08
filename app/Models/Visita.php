<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

	protected $fillable = [
		'letra',
		'ci',
		'nombre',
		'apellido',
		'unidad_id',
		'numero_personas',
		'matricula',
		'marca',
		'modelo',
	];

    public function unidad() {
        return $this->belongsTo(Unidad::class);
    }
}
