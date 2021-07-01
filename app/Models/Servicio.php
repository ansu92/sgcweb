<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = ['nombre', 'descripcion', 'categoria_id'];
    
    /**
     * Obtiene la categoría a la que pertenece el servicio.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function proveedores() {
        return $this->belongsToMany(Proveedor::class);
    }

    public function gastos() {
        return $this->belongsToMany(Gasto::class);
    }
}
