<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class CtrFactura extends Controller
{
    public function show(Factura $factura) {
        return view('factura.show', compact('factura'));
    }
}
