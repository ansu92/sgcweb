<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use PDF;

class CtrIntegrante extends Controller
{
    public function show(Integrante $integrante) {
		return view('integrante.show', compact('integrante'));
	}

	public function exportar()
	{
		$habitantes = Integrante::all();

		$pdf = PDF::loadView('integrante.pdf', compact('habitantes'));
		return $pdf->stream('habitantes.pdf');
	}
}
