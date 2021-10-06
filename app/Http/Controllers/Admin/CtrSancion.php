<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CtrSancion extends Controller
{
    public function index(){
        return view('admin.sancion.index');
    }
}
