<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CtrUser extends Controller
{
	public function index()
	{
		return view('admin.user.index');
	}

	public function show(User $usuario) {
		return view('admin.user.show', compact('usuario'));
	}
}
