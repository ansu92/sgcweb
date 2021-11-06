<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use PDF;

class CtrCuenta extends Controller
{
	public function index()
	{
		return view('cuenta.index');
	}

	public function show(Cuenta $cuenta)
	{
		return view('cuenta.show', compact('cuenta'));
	}

	public function exportar()
	{
		$cuentas = Cuenta::all();

		$pdf = PDF::loadView('cuenta.pdf', compact('cuentas'));
		return $pdf->stream('cuentas.pdf');
	}
}
