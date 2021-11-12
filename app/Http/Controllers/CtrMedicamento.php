<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use PDF;

class CtrMedicamento extends Controller
{
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
