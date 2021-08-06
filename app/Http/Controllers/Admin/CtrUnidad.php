<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unidad;

class CtrUnidad extends Controller
{
	public function index()
	{
		return view('admin.unidad.index');
	}

	public function show(Unidad $unidad) {
		return view('admin.unidad.show', compact('unidad'));
	}
}
