<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unidad;
use PDF;

class CtrUnidad extends Controller
{
	public function index()
	{
		return view('admin.unidad.index');
	}

	public function show(Unidad $unidad)
	{
		return view('admin.unidad.show', compact('unidad'));
	}

	public function exportarConPropietario()
	{
		$titulo = 'Lista de unidades con propietario';
		$unidades = Unidad::has('propietario')->get();
		// return view('admin.unidad.pdf', compact('unidades', 'titulo'));

		$pdf = PDF::loadView('admin.unidad.pdf', compact('unidades', 'titulo'));
		return $pdf->stream('unidades-con-propietario.pdf');
	}

	public function exportarSinPropietario()
	{
		$titulo = 'Lista de unidades sin propietario';
		$unidades = Unidad::doesntHave('propietario')->get();

		$pdf = PDF::loadView('admin.unidad.pdf', compact('unidades', 'titulo'));
		return $pdf->stream('unidades-sin-propietario.pdf');
	}

	public function exportarConHabitantes()
	{
		$titulo = 'Lista de unidades con habitantes';
		$unidades = Unidad::has('integrantes')->get();

		$pdf = PDF::loadView('admin.unidad.pdf', compact('unidades', 'titulo'));
		return $pdf->stream('unidades-con-habitantes.pdf');
	}

	public function exportarSinHabitantes()
	{
		$titulo = 'Lista de unidades sin habitantes';
		$unidades = Unidad::doesntHave('integrantes')->get();

		$pdf = PDF::loadView('admin.unidad.pdf', compact('unidades', 'titulo'));
		return $pdf->stream('unidades-sin-habitantes.pdf');
	}
}
