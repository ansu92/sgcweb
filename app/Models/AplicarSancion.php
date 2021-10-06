<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicarSancion extends Model
{
    use HasFactory;

    protected $table = 'sancion_unidad';

    protected $fillable = [
        'unidad_id',
        'sancion_id',
        'monto_pagar',
    ];
}
