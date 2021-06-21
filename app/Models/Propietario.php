<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

	 public function integrante() {
		 return $this->belongsTo(Integrante::class);
	 }

    public function unidades() {
        return $this->hasMany(Unidad::class);
    }
}
