<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoPropietario extends Model
{
    use HasFactory;

	protected $table = 'pagos_propietario';
	protected $fillable = [
		'descripcion',
		'monto',
		'fecha',
		'referencia',
		'fondo_id',
		'unidad_id',
		'factura_id',
	];
}
