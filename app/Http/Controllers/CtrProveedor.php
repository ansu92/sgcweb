<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;

class CtrProveedor extends Controller
{

	public function index()
	{
		return view('proveedor.index');
	}

	public function show(Proveedor $proveedor)
	{
		return view('proveedor.show', compact('proveedor'));
	}
}
