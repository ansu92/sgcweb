<?php

namespace App\Models;

use App\Models\Gasto;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GastoComun extends Gasto
{
    use HasFactory;

    protected $table = 'gastos_comunes';
}
