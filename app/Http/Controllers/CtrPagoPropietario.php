<?php

namespace App\Http\Controllers;

use App\Models\Condominio;
use App\Models\PagoPropietario;
use App\Models\Recibo;
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

	public function exportarRecibo(Recibo $recibo)
	{
		$condominio = Condominio::first();

		if ($recibo->pago->moneda == 'Bolívar') {
			$recibo->pago->monto .= ' Bs';
		} else if ($recibo->pago->moneda == 'Dólar') {
			$recibo->pago->monto .= '$';
		}

		$pdf = PDF::loadView('pago-propietario.recibo', compact('recibo', 'condominio'));
		return $pdf->stream('recibo.pdf');
	}
}
