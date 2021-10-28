<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use App\Models\Condominio;
use Illuminate\Support\Facades\Auth;

class CtrInicio extends Controller
{
	public function __invoke()
	{
		if (Auth::user()->administrador) {

			if (Condominio::first()) {
				$comunicados = Comunicado::orderBy('created_at', 'desc')->take(5)->get();

				return view('welcome', compact('comunicados'));
			} else {

				return redirect()->route('admin.condominio');
			}
		} else {
			$comunicados = Comunicado::orderBy('created_at', 'desc')->take(5)->get();

			return view('welcome', compact('comunicados'));
		}
	}
}
