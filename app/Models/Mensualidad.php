<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    use HasFactory;

    protected $table = 'mensualidades';

    protected $fillable = [
        'monto',
        'moneda',
    ];
}
