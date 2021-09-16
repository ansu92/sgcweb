<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CtrInicio extends Controller
{
    public function __invoke()
	{
		return view('admin.inicio');
	}
}
