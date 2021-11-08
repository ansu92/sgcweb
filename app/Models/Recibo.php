<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'pago_propietario_id',
    ];

    public function pago() {
        return $this->belongsTo(PagoPropietario::class, 'pago_propietario_id');
    }
}
