<?php

namespace App\Models;

use App\Models\Integrante;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Integrante
{
	use HasFactory;
	use SoftDeletes;

	protected $table = 'administradores';

	protected $fillable = ['rol'];

	/**
	 * Las relaciones que siempre deberían cargarse.
	 *
	 * @var array
	 */
	protected $with = ['integrante'];


	public function integrante()
	{
		return $this->belongsTo(Integrante::class);
	}

	public function comunicados()
	{
		return $this->hasMany(Comunicado::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
