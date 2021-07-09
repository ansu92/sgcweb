<?php

namespace App\Models;

use App\Models\Gasto;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GastoExtraordinario extends Gasto
{
    use HasFactory;

    protected $table = 'gastos_extraordinarios';
	protected $fillable = [
		'gasto_id',
		'num_meses',
	];

	public function gasto() {
		return $this->belongsTo(Gasto::class);
	}

    public function asamblea() {
        return $this->belongsTo(Asamblea::class);
    }
}
