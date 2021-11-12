<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Support\Str;
use PDF;

class CtrVisita extends Controller
{
	public function index()
	{
		return view('visita.index');
	}

	public function show(Visita $visita)
	{
		return view('visita.show', compact('visita'));
	}

	public function lista()
	{
		return view('visita.lista');
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
		$fechaDesde = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$fechaHasta = Str::before($filtros, '-');

		$visitas = Visita::all();

		if ($fechaDesde) {
			$visitas = $visitas->intersect(Visita::where('fecha_hora_entrada', '>', $fechaDesde)->get());
		}

		if ($fechaHasta) {
			$visitas = $visitas->intersect(Visita::where('fecha_hora_salida', '<', $fechaHasta)->get());
		}

		$visitas = $visitas->toQuery()
			->where(function ($query) use ($busqueda) {
				$query->where('nombre', 'LIKE', '%' . $busqueda . '%')
					->orWhere('apellido', 'LIKE', '%' . $busqueda . '%');
			})
			->orderBy($orden, $direccion)
			->get();

		$pdf = PDF::loadView('visita.pdf', compact('visitas'));
		return $pdf->stream('visitas.pdf');
	}
}
