<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comunicado;

class CtrComunicado extends Controller
{
    public function index() {
		return view('admin.comunicado.index');
	}

	public function show(Comunicado $comunicado) {
		return view('admin.comunicado.show', compact('comunicado'));
	}
}
