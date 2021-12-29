<?php

namespace App\Models;

use App\Traits\WithCurrencies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasaCambio extends Model
{
    use HasFactory;
    use WithCurrencies;

    protected $table = 'tasas_cambio';

    protected $fillable = [
        'tasa',
        'fecha',
    ];

    public function getTasaFormateadaAttribute() {
        return $this->formatearMonto($this->tasa, 'Bolívar');
    }
}
