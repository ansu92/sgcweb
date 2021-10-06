<?php

namespace App\Http\Controllers;

use App\Models\AplicarSancion;

class CtrAplicarSancion extends Controller
{
    public function index(){
        return view('sancion.index');
    }

    public function show(AplicarSancion $sancion){
        return view('sancion.show', compact('sancion'));
    }
}
