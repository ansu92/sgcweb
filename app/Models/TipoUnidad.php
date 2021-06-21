<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUnidad extends Model
{
	use HasFactory;

	protected $fillable = ['nombre', 'descripcion', 'area'];
	protected $table = 'tipo_unidades';

	public function unidades()
	{
		return $this->hasMany(Unidad::class);
	}
}
