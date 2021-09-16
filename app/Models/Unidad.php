<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unidad extends Model
{
	use HasFactory;

	protected $fillable = ['numero', 'direccion', 'tipo_unidad_id', 'propietario_id'];
	protected $table = 'unidades';

	public static function getAreaTotal(): float
	{
		return DB::table('unidades')
			->join('tipo_unidades', 'unidades.tipo_unidad_id', '=', 'tipo_unidades.id')
			->sum('area');
	}

	public function getRouteKeyName()
	{
		return 'numero';
	}

	public function integrantes()
	{
		return $this->hasMany(Integrante::class);
	}

	public function visitas()
	{
		return $this->hasMany(Visita::class);
	}

	public function tipoUnidad()
	{
		return $this->belongsTo(TipoUnidad::class);
	}

	public function propietario()
	{
		return $this->belongsTo(Propietario::class);
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}
}
