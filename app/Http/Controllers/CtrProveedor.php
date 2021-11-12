<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use PDF;

class CtrProveedor extends Controller
{

	public function index()
	{
		return view('proveedor.index');
	}

	public function show(Proveedor $proveedor)
	{
		return view('proveedor.show', compact('proveedor'));
	}

	public function exportar()
	{
		$proveedores = Proveedor::all();

		$pdf = PDF::loadView('proveedor.pdf', compact('proveedores'));
		return $pdf->stream('proveedores.pdf');
	}
}
