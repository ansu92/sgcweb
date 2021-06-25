<?php

namespace App\Http\Controllers;

use App\Models\Integrante;

class CtrIntegrante extends Controller
{
    public function show(Integrante $integrante) {
		return view('integrante.show', compact('integrante'));
	}
}
