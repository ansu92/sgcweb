<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;

class CtrComunicado extends Controller
{
	public function __construct()
	{
		$this->middleware('can:comunicado.index')->only('index');
		$this->middleware('can:comunicado.show')->only('show');
	}

	public function index()
	{
		return view('comunicado.index');
	}

	public function show(Comunicado $comunicado)
	{
		return view('comunicado.show', compact('comunicado'));
	}
}
