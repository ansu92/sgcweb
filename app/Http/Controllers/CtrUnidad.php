<?php

namespace App\Http\Controllers;

use App\Models\Unidad;

class CtrUnidad extends Controller
{
    public function __invoke(Unidad $unidad)
	{
		return view('unidad.show', compact('unidad'));
	}
}
