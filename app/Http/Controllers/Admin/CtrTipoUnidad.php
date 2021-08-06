<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoUnidad;

class CtrTipoUnidad extends Controller
{

	public function index()
	{
		return view('admin.tipo-unidad.index');
	}

	public function show(TipoUnidad $tipoUnidad)
	{
		return view('admin.tipo-unidad.show', compact('tipoUnidad'));
	}

}
