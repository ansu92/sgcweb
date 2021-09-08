<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;

class CtrVisita extends Controller
{
    public function index() {
		return view('visita.index');
	}

	public function show(Visita $visita) {
		return view('visita.show', compact('visita'));
	}
}
