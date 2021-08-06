<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;

class CtrComunicado extends Controller
{
    public function index() {
		return view('comunicado.index');
	}

	public function show(Comunicado $comunicado) {
		return view('comunicado.show', compact('comunicado'));
	}
}
