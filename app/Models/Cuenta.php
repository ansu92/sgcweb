<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = ['numero','tipo','documento','beneficiario','banco_id'];

    public function banco() {
        return $this->belongsTo(Banco::class);
    }
}
