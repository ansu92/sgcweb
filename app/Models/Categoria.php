<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;
	use SoftDeletes;

	 protected $fillable = ['nombre', 'descripcion',];

    public function servicios() {
        return $this->hasMany(Servicio::class);
    }
}
