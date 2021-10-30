<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BtnAdmin extends Component
{
    public $nombre;
    public $imagen;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nombre, $imagen)
    {
        $this->nombre = $nombre;
        $this->imagen = $imagen;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btn-admin');
    }
}
