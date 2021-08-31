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

	protected $fillable = [
		'rol',
		'integrante_id',
		'user_id',
	];

	/**
	 * Las relaciones que siempre deberían cargarse.
	 *
	 * @var array
	 */
	protected $with = ['integrante'];

	protected static function booted()
	{
		static::creating(function ($administrador) {
			if (!\App::runningInConsole()) {
				$persona = $administrador->integrante;

				$usuario = User::create([
					'name' => $persona->nombre . ' ' . $persona->apellido,
					'email' => $persona->email,
					'password' => bcrypt($persona->email),
				]);

				$administrador->user()->associate($usuario);
			}
		});
	}

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
