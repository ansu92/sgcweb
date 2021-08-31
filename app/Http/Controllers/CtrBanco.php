<?php

namespace App\Http\Controllers;

use App\Models\Banco;

class CtrBanco extends Controller
{
	public function __construct()
	{
		$this->middleware('can:banco.index')->only('index');
		$this->middleware('can:banco.show')->only('show');
	}
    public function index()
    {
        return view('banco.index');
    }

    public function show(Banco $banco)
    {
        return view('banco.show', compact('banco'));
    }
}
