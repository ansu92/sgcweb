<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class ShowCategoria extends Component
{
	public Categoria $categoria;
	
    public function render()
    {
        return view('livewire.show-categoria');
    }
}
