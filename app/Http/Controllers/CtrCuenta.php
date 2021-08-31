<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;

class CtrCuenta extends Controller
{
    public function index()
	{
		return view('cuenta.index');
	}
	public function show(Cuenta $cuenta)
	{
		return view('cuenta.show', compact('cuenta'));
	}
}
