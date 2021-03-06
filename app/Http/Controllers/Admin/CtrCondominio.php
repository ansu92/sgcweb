<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condominio;
use App\Models\Mensualidad;
use App\Models\TasaCambio;
use Illuminate\Http\Request;

class CtrCondominio extends Controller
{
	public function index()
	{
		return view('admin.condominio.index');
	}

	public function store(Request $request)
	{
		$request->validate([
			'rif' => 'required|max:10',
			'nombre' => 'required',
			'direccion' => 'required',
			'tasa' => 'required|numeric|gt:0',
			'monto' => 'required|numeric|gt:0',
			'moneda' => 'required',
		]);

		Condominio::create([
			'rif' => 'J-' . $request->rif,
			'nombre' => $request->nombre,
			'direccion' => $request->direccion,
		]);

		TasaCambio::create([
			'tasa' => $request->tasa,
		]);

		Mensualidad::create([
			'monto' => $request->monto,
			'moneda' => $request->moneda,
		]);

		return redirect()->route('admin');
	}
}
