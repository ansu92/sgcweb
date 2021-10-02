<?php

namespace App\Http\Controllers;

use App\Models\PagoPropietario;

class CtrPagoPropietario extends Controller
{
    public function index() {
		return view('pago-propietario.index');
	}

	public function create() {
		return view('pago-propietario.create');
	}

	public function show(PagoPropietario $pagoPropietario) {
		$pago = $pagoPropietario;
		return view('pago-propietario.show', compact('pago'));
	}
}
