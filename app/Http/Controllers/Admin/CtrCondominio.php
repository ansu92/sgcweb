<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CtrCondominio extends Controller
{
    public function index()
	{
		return view('admin.condominio.index');
	}

    public function store()
	{
		return redirect()->route('admin.condominio');
	}
}
