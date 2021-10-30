<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BtnAdminAncho extends Component
{
    public $nombre;
    public $icono;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nombre, $icono)
    {
        $this->nombre = $nombre;
        $this->icono = $icono;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btn-admin-ancho');
    }
}
