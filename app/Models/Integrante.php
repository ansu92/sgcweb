<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
    }
/* 
    public function propietario() {
        return $this->hasOne(Propietario::class);
    }
 */
    public function asambleas() {
        return $this->belongsToMany(Asamblea::class, 'asistentes');
    }
}
