<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banco;

class CtrBanco extends Controller
{
	public function __construct()
	{
		$this->middleware('can:admin.banco.index')->only('index');
		$this->middleware('can:admin.banco.show')->only('show');
	}
    public function index()
    {
        return view('admin.banco.index');
    }

    public function show(Banco $banco)
    {
        return view('admin.banco.show', compact('banco'));
    }
}
