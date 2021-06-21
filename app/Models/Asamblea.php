<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asamblea extends Model
{
    use HasFactory;

    public function gastos() {
        return $this->hasMany(GastoExtraordinario::class);
    }

    public function integrantes() {
        return $this->belongsToMany(Integrante::class, 'asistentes');
    }
}
