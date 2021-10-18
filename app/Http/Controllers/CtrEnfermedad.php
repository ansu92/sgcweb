<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;

class CtrEnfermedad extends Controller
{
    public function index() {
        return view('enfermedad.index');
    }

    public function show(Enfermedad $enfermedad) {
        return view('enfermedad.show', compact('enfermedad'));
    }
}
