<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'tipo',
        'documento',
        'beneficiario',
        'banco_id',
        'telefono',
        'publica',
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function fondo()
    {
        return $this->hasOne(Fondo::class);
    }

    // public function ocultarNumero()
    // {
    //     $this->numero = Str::substr($this->numero, 0, 4) . '-####-##-######' . Str::substr($this->numero, 16, 4);
    // }

    public function getNumeroOcultoAttribute()
    {
        return $this->numero = Str::substr($this->numero, 0, 4) . '-####-##-######' . Str::substr($this->numero, 16, 4);
    }
}
