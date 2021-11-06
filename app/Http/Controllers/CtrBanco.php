<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use PDF;

class CtrBanco extends Controller
{
	public function __construct()
	{
		// $this->middleware('can:banco.index')->only('index');
		// $this->middleware('can:banco.show')->only('show');
	}
    public function index()
    {
        return view('banco.index');
    }

    public function show(Banco $banco)
    {
        return view('banco.show', compact('banco'));
    }

    public function exportar() {
        $bancos = Banco::all();
       
        $pdf = PDF::loadView('banco.pdf', compact('bancos'));
        return $pdf->stream('bancos.pdf');
    }
}
