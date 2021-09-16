<?php

namespace App\Http\Controllers;

use App\Models\Unidad;

class CtrUnidad extends Controller
{
	public function index()
	{
		return view('unidad.index');
	}

	public function show(Unidad $unidad)
	{
		return view('unidad.show', compact('unidad'));
	}
}
