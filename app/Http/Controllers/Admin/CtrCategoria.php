<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;

class CtrCategoria extends Controller
{
	public function index()
	{
		return view('admin.categoria.index');
	}

	public function show(Categoria $categoria)
	{
		return view('admin.categoria.show', compact('categoria'));
	}
}
