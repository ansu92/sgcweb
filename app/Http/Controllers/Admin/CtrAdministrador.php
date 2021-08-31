<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrador;

class CtrAdministrador extends Controller
{
    public function index() {
		return view('admin.administrador.index');
	}

	public function show(Administrador $administrador) {
		return view('admin.administrador.show', compact('administrador'));
	}
}
