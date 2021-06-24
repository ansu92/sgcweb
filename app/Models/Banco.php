<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function cuentas() {
        return $this->hasMany(Cuenta::class);
    }
}
