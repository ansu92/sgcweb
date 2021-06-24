<?php

namespace App\Http\Controllers;


class CtrUser extends Controller
{
	public function __invoke()
	{
		return view('user.index');
	}
}
