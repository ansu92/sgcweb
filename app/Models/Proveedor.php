<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'documento',
        'nombre',
        'slug',
        'contacto',
        'telefono',
        'email',
        'direccion',
    ];

    public function servicios() {
        return $this->belongsToMany(Servicio::class);
    }
}
