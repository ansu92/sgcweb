<?php

namespace App\Http\Livewire\Categoria;

use App\Models\Categoria;
use Livewire\Component;

class ShowCategoria extends Component
{
	public Categoria $categoria;
	
    public function render()
    {
        return view('livewire.categoria.show-categoria');
    }
}
