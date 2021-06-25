<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Integrante extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'documento',
		'nombre',
		's_nombre',
		'apellido',
		's_apellido',
		'telefono',
		'unidad_id',
	];

	public function user()
	{
		return $this->hasOne(User::class);
	}

	public function propietario()
	{
		return $this->hasOne(Propietario::class);
	}

	public function unidad()
	{
		return $this->belongsTo(Unidad::class);
	}

	public function asambleas()
	{
		return $this->belongsToMany(Asamblea::class, 'asistentes');
	}
}
