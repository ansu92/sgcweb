<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sancion;
use PDF;

class CtrSancion extends Controller
{
    public function index(){
        return view('admin.sancion.index');
    }

	public function exportar()
	{
		$sanciones = Sancion::all();

		$pdf = PDF::loadView('sancion.pdf', compact('sanciones'));
		return $pdf->stream('sanciones.pdf');
	}
}
