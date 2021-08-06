<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class CtrAdministrador extends Controller
{
    public function index() {
		return view('administrador.index');
	}

	public function show(Administrador $administrador) {
		return view('administrador.show', compact('administrador'));
	}
}
