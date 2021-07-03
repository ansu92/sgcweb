<?php

namespace App\Http\Controllers;

use App\Models\Asamblea;
use Illuminate\Http\Request;

class CtrAsamblea extends Controller
{
    public function index()
    {
        return view('asamblea.index');
    }
    public function show(Asamblea $asamblea)
    {
        return view('asamblea.show', compact('asamblea'));
    }
}
