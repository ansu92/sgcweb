<?php

namespace App\View\Components;

use App\Models\Condominio;
use App\Models\Unidad;
use Illuminate\View\Component;

class CardCondominio extends Component
{
    public $condominio;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->condominio = Condominio::first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $numUnidades = Unidad::all()->count();

        return view('components.card-condominio', compact('numUnidades'));
    }
}
