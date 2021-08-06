<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CtrConfiguracion extends Controller
{
    public function __invoke()
	{
		return view('settings');
	}
}
