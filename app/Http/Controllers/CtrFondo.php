<?php

namespace App\Http\Controllers;

use App\Models\Condominio;
use App\Models\Fondo;
use PDF;

class CtrFondo extends Controller
{
	public function index()
	{
		return view('fondo.index');
	}

	public function show(Fondo $fondo)
	{
		return view('fondo.show', compact('fondo'));
	}

	public function exportarMovimientos(Fondo $fondo)
	{
		$condominio = Condominio::first();

		$movimientos = $fondo->getMovimientos();

		$pdf = PDF::loadView('fondo.movimiento', compact('movimientos', 'condominio'));
		return $pdf->stream('movimientos.pdf');
	}
}
