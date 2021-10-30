<?php

namespace App\View\Components;

use App\Models\Fondo;
use Illuminate\View\Component;

class CardFondo extends Component
{
    public $fondo;
    // public $saldo;
    // public $moneda;
    // public $descripcion;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fondo)
    {
        // $this->saldo = $saldo;
        // $this->moneda = $moneda;
        // $this->descripcion = $descripcion;
        $this->fondo = $fondo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-fondo');
    }
}
