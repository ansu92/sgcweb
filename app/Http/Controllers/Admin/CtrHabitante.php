<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Integrante;
use Illuminate\Http\Request;

class CtrHabitante extends Controller
{
	public function index()
	{
		return view('admin.habitante.index');
	}

	public function show(Integrante $habitante)
	{
		return view('admin.habitante.show', compact('habitante'));
	}
}
