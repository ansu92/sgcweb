<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;

class CtrServicio extends Controller
{
    public function index() {
		return view('admin.servicio.index');
	}

	public function show(Servicio $servicio) {
		return view('admin.servicio.show', compact('servicio'));
	}
}
