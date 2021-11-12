<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use PDF;

class CtrServicio extends Controller
{
    public function index() {
		return view('servicio.index');
	}

	public function show(Servicio $servicio) {
		return view('servicio.show', compact('servicio'));
	}

	public function exportar()
	{
		$servicios = Servicio::all();

		$pdf = PDF::loadView('servicio.pdf', compact('servicios'));
		return $pdf->stream('servicios.pdf');
	}
}
