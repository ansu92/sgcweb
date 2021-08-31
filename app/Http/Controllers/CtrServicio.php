<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class CtrServicio extends Controller
{
    public function index() {
		return view('servicio.index');
	}

	public function show(Servicio $servicio) {
		return view('servicio.show', compact('servicio'));
	}
}
