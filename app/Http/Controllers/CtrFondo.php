<?php

namespace App\Http\Controllers;

use App\Models\Fondo;
use Illuminate\Http\Request;

class CtrFondo extends Controller
{
    public function index() {
		return view('fondo.index');
	}

	public function show(Fondo $fondo) {
		return view('fondo.show', compact('fondo'));
	}
}
