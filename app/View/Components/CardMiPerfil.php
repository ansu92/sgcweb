<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardMiPerfil extends Component
{
	public User $usuario;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->usuario = Auth::user();
		$this->usuario->propietario->loadCount('unidades');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-mi-perfil');
    }
}
