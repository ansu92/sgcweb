<?php

namespace App\Http\Controllers;

use App\Models\Gasto;

class CtrGasto extends Controller
{
	public function __construct()
	{
		$this->middleware('can:gasto.index')->only('index');
		$this->middleware('can:gasto.show')->only('show');
	}

	public function index() {
		return view('gasto.index');
	}

	public function show(Gasto $gasto) {
		return view('gasto.show', compact('gasto'));
	}
}
