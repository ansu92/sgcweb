<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasaCambio extends Model
{
    use HasFactory;

    protected $table = 'tasas_cambio';

    protected $fillable = [
        'tasa',
        'fecha',
    ];
}
