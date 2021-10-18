<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enfermedad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'enfermedades';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function integrantes() {
        return $this->belongsToMany(Integrante::class);
    }
}
