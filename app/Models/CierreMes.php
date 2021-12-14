<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CierreMes extends Model
{
    use HasFactory;

    protected $table = 'cierres_mes';
    protected $fillable = ['mes', 'moneda', 'tasa_cambio_id'];
}
