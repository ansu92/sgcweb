<?php

namespace App\Http\Controllers;

use App\Models\Condominio;
use App\Models\PagoPropietario;
use PDF;

class CtrPagoPropietario extends Controller
{
	public function index()
	{
		return view('pago-propietario.index');
	}

	public function create()
	{
		return view('pago-propietario.create');
	}

	public function show(PagoPropietario $pagoPropietario)
	{
		$pago = $pagoPropietario;
		return view('pago-propietario.show', compact('pago'));
	}

	public function confirmar()
	{
		return view('pago-propietario.confirmar');
	}

	public function exportarRecibo(PagoPropietario $pago)
	{
		$condominio = Condominio::first();

		$pdf = PDF::loadView('pago-propietario.recibo', compact('pago', 'condominio'));
		return $pdf->stream('recibo.pdf');
	}
}
