<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CtrUser extends Controller
{
	public function __invoke()
	{
		return view('admin.user.index');
	}
}
