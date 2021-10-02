<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;

class CtrInicio extends Controller
{
	public function __invoke()
	{
		$comunicados = Comunicado::orderBy('created_at', 'desc')->take(4)->get();

		return view('welcome', compact('comunicados'));
	}
}
