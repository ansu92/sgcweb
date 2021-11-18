<?php

namespace App\Http\Controllers;

use App\Models\Pago;

class CtrPago extends Controller
{
	public function __construct()
	{
		$this->middleware('can:pago-condominio.index')->only('index');
		$this->middleware('can:pago-condominio.show')->only('show');
	}

    public function create() {
		return view('pago.create');
	}

	public function index() {
		return view('pago.index');
	}

	public function show(Pago $pagoCondominio) {
		return view('pago.show', compact('pagoCondominio'));
	}
}
