<?php

namespace App\Http\Controllers;

use App\Models\Gasto;

class CtrGasto extends Controller
{
    public function index() {
		return view('gasto.index');
	}

	public function show(Gasto $gasto) {
		return view('gasto.show', compact('gasto'));
	}
}
