<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CtrCierreMes extends Controller
{
    public function __invoke()
	{
		return view('cierre-mes.index');
	}
}
