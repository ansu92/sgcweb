<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CtrAsamblea extends Controller
{
    public function index()
    {
        return view('asamblea.index');
    }
}
