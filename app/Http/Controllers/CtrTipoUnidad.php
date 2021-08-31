<?php

namespace App\Http\Controllers;

use App\Models\TipoUnidad;

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

}
