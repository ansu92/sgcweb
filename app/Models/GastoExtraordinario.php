<?php

namespace App\Models;

use App\Models\Gasto;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GastoExtraordinario extends Gasto
{
    use HasFactory;

    protected $table = 'gastos_extraordinarios';

    public function asamblea() {
        return $this->belongsTo(Asamblea::class);
    }
}
