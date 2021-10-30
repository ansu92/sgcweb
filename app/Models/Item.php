<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use HasFactory;

	protected $fillable = [
		'itemable_id',
		'itemable_type',
		'monto',
		'fecha',
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function itemable() {
		return $this->morphTo();
	}
}
