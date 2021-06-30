<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;
	use SoftDeletes;

    protected $table = 'proveedores';

    protected $fillable = [
        'letra',
        'documento',
        'nombre',
        'contacto',
        'telefono',
        'email',
        'direccion',
    ];

    public function servicios() {
        return $this->belongsToMany(Servicio::class);
    }
}
