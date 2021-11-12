<?php

namespace App\Http\Controllers;

use App\Models\TipoUnidad;
use PDF;

class CtrTipoUnidad extends Controller
{

	public function index()
	{
		return view('tipo-unidad.index');
	}

	public function show(TipoUnidad $tipoUnidad)
	{
		return view('tipo-unidad.show', compact('tipoUnidad'));
	}

	public function exportar()
	{
		$tiposUnidad = TipoUnidad::all();

		$pdf = PDF::loadView('tipo-unidad.pdf', compact('tiposUnidad'));
		return $pdf->stream('tipos-unidad.pdf');
	}
}
