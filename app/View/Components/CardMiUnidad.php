<?php

namespace App\View\Components;

use App\Models\Unidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardMiUnidad extends Component
{
	public Unidad $unidad;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unidad = Auth::user()->propietario->integrante->unidad;
		$this->unidad->loadCount('integrantes');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-mi-unidad');
    }
}
