<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

class CtrCategoria extends Controller
{

	public function index()
	{
		return view('categoria.index');
	}
}
