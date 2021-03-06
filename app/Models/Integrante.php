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
		'letra',
		'documento',
		'nombre',
		's_nombre',
		'apellido',
		's_apellido',
		'fecha_nacimiento',
		'telefono',
		'email',
		'unidad_id',
	];

	public function getNombreCompletoAttribute()
	{
		return $this->nombre . ' ' . $this->apellido;
	}

	public function propietario()
	{
		return $this->hasOne(Propietario::class);
	}

	public function administrador()
	{
		return $this->hasOne(Administrador::class);
	}

	public function unidad()
	{
		return $this->belongsTo(Unidad::class);
	}

	public function asambleas()
	{
		return $this->belongsToMany(Asamblea::class, 'asistentes');
	}

	public function enfermedades()
	{
		return $this->belongsToMany(Enfermedad::class);
	}

	public function medicamentos()
	{
		return $this->belongsToMany(Medicamento::class);
	}
}
