<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class TagRol extends Component
{
    public Role $rol;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Role $rol)
    {
        $this->rol = $rol;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tag-rol');
    }
}
