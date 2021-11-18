<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use PDF;

class CtrMedicamento extends Controller
{
	public function __construct()
	{
		$this->middleware('can:medicamento.index')->only('index');
		$this->middleware('can:medicamento.show')->only('show');
	}

    public function index() {
        return view('medicamento.index');
    }

    public function show(Medicamento $medicamento) {
        return view('medicamento.show', compact('medicamento'));
    }

    public function exportar()
    {
        $medicamentos = Medicamento::all();

        $pdf = PDF::loadView('medicamento.pdf', compact('medicamentos'));
        return $pdf->stream('medicamentos.pdf');
    }
}
