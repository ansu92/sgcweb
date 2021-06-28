<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CtrCuenta extends Controller
{
    public function index()
	{
		return view('cuenta.index');
	}
}
