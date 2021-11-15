<?php

namespace App\Http\Controllers;

use App\Models\Condominio;
use App\Models\Fondo;
use Illuminate\Support\Str;
use PDF;

class CtrFondo extends Controller
{
	public function index()
	{
		return view('fondo.index');
	}

	public function show(Fondo $fondo)
	{
		return view('fondo.show', compact('fondo'));
	}

	public function exportar($filtros)
	{
		$filtros = Str::after($filtros, '-');
		$busqueda = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$orden = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$direccion = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$moneda = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$minimo = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$maximo = Str::before($filtros, '-');
		$fondos = Fondo::all();

		switch ($moneda) {
			case '0':
				$fondos = $fondos->intersect(Fondo::where('moneda', 'Dólar')->get());
				break;

			case '1':
				$fondos = $fondos->intersect(Fondo::where('moneda', 'Bolívar')->get());
				break;

			default:
				# code...
				break;
		}

		if ($minimo != '') {
			$fondos = $fondos->intersect(Fondo::where('saldo', '>=', $minimo)->get());
		}

		if ($maximo != '') {
			$fondos = $fondos->intersect(Fondo::where('saldo', '<=', $maximo)->get());
		}

		$fondos = $fondos->toQuery()
			->where('descripcion', 'like', '%' . $busqueda . '%')
			->orderBy($orden, $direccion)
			->get();

		$condominio = Condominio::first();

		$pdf = PDF::loadView('fondo.pdf', compact('fondos', 'condominio'));
		return $pdf->stream('fondos.pdf');
	}

	public function exportarMovimientos(Fondo $fondo)
	{
		$condominio = Condominio::first();

		$movimientos = $fondo->getMovimientos();

		$pdf = PDF::loadView('fondo.movimiento', compact('movimientos', 'condominio'));
		return $pdf->stream('movimientos.pdf');
	}
}
