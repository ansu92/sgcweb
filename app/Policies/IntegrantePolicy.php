<?php

namespace App\Policies;

use App\Models\Integrante;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntegrantePolicy
{
    use HandlesAuthorization;

    public function view(User $usuario, Integrante $persona)
    {
        $unidades = $usuario->propietario->unidades;

        foreach ($unidades as $item) {
            $personas = $item->integrantes->pluck('id')->toArray();
        }

        return in_array($persona->id, $personas);
    }
}
