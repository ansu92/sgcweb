<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use PDF;

class CtrCategoria extends Controller
{
	public function index()
	{
		return view('categoria.index');
	}

	public function show(Categoria $categoria)
	{
		return view('categoria.show', compact('categoria'));
	}

    public function exportar() {
        $categorias = Categoria::all();
       
        $pdf = PDF::loadView('categoria.pdf', compact('categorias'));
        return $pdf->stream('categorias.pdf');
    }
}
