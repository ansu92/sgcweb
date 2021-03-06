<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use App\Models\Condominio;
use Illuminate\Support\Facades\Auth;

class CtrInicio extends Controller
{
	public function __invoke()
	{
		$usuario = Auth::user();

		if ($usuario->administrador) {

			if ($usuario->propietario) {
				// Si el usuario es un propietario
				$comunicados = Comunicado::orderBy('created_at', 'desc')->take(5)->get();

				return view('welcome', compact('comunicados'));
			} else {

				if ($usuario->hasRole('Portero')) {
					// Si el usuario es un portero

					return redirect()->route('visita.index');
				} else {

					if (Condominio::first()) {
						// Si los datos de condominio están registrados
						return redirect()->route('admin.home');
					} else {

						return redirect()->route('admin.condominio');
					}
				}
			}
		} else {
			$comunicados = Comunicado::orderBy('created_at', 'desc')->take(5)->get();

			return view('welcome', compact('comunicados'));
		}
	}
}
