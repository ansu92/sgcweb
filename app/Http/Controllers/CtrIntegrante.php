<?php

namespace App\Http\Controllers;

class CtrIntegrante extends Controller
{
    public function __invoke() {
		return view('integrante.index');
	}
}
