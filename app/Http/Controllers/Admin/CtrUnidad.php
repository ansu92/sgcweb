<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condominio;
use App\Models\Unidad;
use Illuminate\Support\Str;
use PDF;

class CtrUnidad extends Controller
{
	public function index()
	{
		return view('admin.unidad.index');
	}

	public function show(Unidad $unidad)
	{
		return view('admin.unidad.show', compact('unidad'));
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
		$propietario = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$habitantes = Str::before($filtros, '-');

		$filtros = Str::after($filtros, '-');
		$facturas = Str::before($filtros, '-');

		$unidades = Unidad::all();

		switch ($habitantes) {
			case '0':
				$unidades = $unidades->diff(Unidad::has('integrantes')->get());
				break;
			case '1':
				$unidades = $unidades->diff(Unidad::doesntHave('integrantes')->get());
				break;

			default:
				# code...
				break;
		}

		switch ($propietario) {
			case '0':
				$unidades = $unidades->diff(Unidad::has('propietario')->get());
				break;

			case '1':
				$unidades = $unidades->diff(Unidad::doesntHave('propietario')->get());
				break;

			default:
				# code...
				break;
		}

		switch ($facturas) {
			case '0':
				$unidades = $unidades->diff(Unidad::has('facturas')->get());
				break;

			case '1':
				$unidades = $unidades->diff(Unidad::doesntHave('facturas')->get());
				break;

			default:
				# code...
				break;
		}

		$unidades = $unidades->toQuery()
			->where(function ($query) use ($busqueda) {
				$query->where('numero', 'LIKE', '%' . $busqueda . '%')
					->orWhere('direccion', 'LIKE', '%' . $busqueda . '%');
			})
			->orderBy($orden, $direccion)
			->get();

		$condominio = Condominio::first();

		$pdf = PDF::loadView('admin.unidad.pdf', compact('unidades', 'condominio'));
		return $pdf->stream('unidades.pdf');
	}

    public function exportarConFacturasPendientes($type)
	{
		$condominio = Condominio::first();
        
        $unidades = Unidad::with('facturas')->has('facturas')->get();

		$unidades = $unidades->count() > 0
			? $unidades->filter(function ($unidad) {
				return $unidad->facturas->where('monto_por_pagar', '!=', 0)->count() > 0;
			})
			: [];

		$pdf = PDF::loadView('reporte.unidades-con-facturas-pendientes', compact('unidades', 'condominio'));

		if($type == 1)
		{
			return $pdf->stream('unidades-con-facturas-pendientes.pdf');
		} else if($type == 2){
			return $pdf->download('unidades-con-facturas-pendientes.pdf');
		}
    }
}
