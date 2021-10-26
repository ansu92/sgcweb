<?php

namespace App\Http\Controllers;

class CtrNosotros extends Controller
{
    public function __invoke()
    {
        return view("nosotros.index");
    }
}
