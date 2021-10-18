<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;

class CtrMedicamento extends Controller
{
    public function index() {
        return view('medicamento.index');
    }

    public function show(Medicamento $medicamento) {
        return view('medicamento.show', compact('medicamento'));
    }
}
