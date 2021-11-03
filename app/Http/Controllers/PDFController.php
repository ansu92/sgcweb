<?php

namespace App\Http\Controllers;

use App\Models\Categoria;  
use PDF;

class PDFController extends Controller
{
    public function PDF() {
        $pdf = PDF::loadView('prueba');

        // Esta línea sirve descargar
        // return $pdf->download('holo.pdf');

        // Esta línea sirve para mostrar
        return $pdf->stream();
    }

    public function PDFCategorias() {
        $categorias = Categoria::all();
       
        $pdf = PDF::loadView('prueba', compact('categorias'));
        return $pdf->stream('productos.pdf');
    }
}
