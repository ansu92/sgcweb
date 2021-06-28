<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banco extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nombre'];

    public function cuentas() {
        return $this->hasMany(Cuenta::class);
    }
}
