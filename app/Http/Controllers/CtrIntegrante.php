<?php

namespace App\Http\Controllers;

use App\Models\Condominio;
use App\Models\Integrante;
use PDF;

class CtrIntegrante extends Controller
{
    public function show(Integrante $integrante) {
		$this->authorize('view', $integrante);

		return view('integrante.show', compact('integrante'));
	}

	public function exportar()
	{
		$habitantes = Integrante::has('unidad')->get();

		$condominio = Condominio::first();

		$pdf = PDF::loadView('integrante.pdf', compact('habitantes', 'condominio'));
		return $pdf->stream('habitantes.pdf');
	}
}
