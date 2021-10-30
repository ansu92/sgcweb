<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
	use HasFactory;

	protected $table = 'iva';

	protected $fillable = [
		'factor',
		'fecha',
	];
}
