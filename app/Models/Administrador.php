<?php

namespace App\Models;

use App\Models\Integrante;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrador extends Integrante
{
    use HasFactory;

    protected $table = 'administradores';

    public function comunicados() {
        return $this->hasMany(Comunicado::class);
    }
}
