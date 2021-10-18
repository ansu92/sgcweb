<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;

class CtrInicio extends Controller
{
	public function __invoke()
	{
		$comunicados = Comunicado::orderBy('created_at', 'desc')->take(5)->get();

		return view('welcome', compact('comunicados'));
	}
}
