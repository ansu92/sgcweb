<?php

namespace App\Http\Controllers;

use App\Models\Fondo;

class CtrFondo extends Controller
{
    public function index() {
		return view('fondo.index');
	}

	public function show(Fondo $fondo) {
		return view('fondo.show', compact('fondo'));
	}
}
