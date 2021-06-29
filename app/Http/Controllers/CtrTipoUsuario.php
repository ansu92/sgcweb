<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;

class CtrTipoUsuario extends Controller
{

	public function index()
	{
		return view('tipo-usuario.index');
	}

	public function show(TipoUsuario $tipoUsuario)
	{
		return view('tipo-usuario.show', compact('tipoUsuario'));
	}

}
