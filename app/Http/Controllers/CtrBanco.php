<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBanco;
use App\Models\Banco;
use Illuminate\Support\Str;

class CtrBanco extends Controller
{
    public function index()
    {
        return view('banco.index');
    }

    public function create()
    {
        return view('banco.create');
    }

    public function store(StoreBanco $request)
    {

        $banco = new Banco();

        $banco->nombre = $request->nombre;
        $banco->slug = Str::slug($banco->nombre);

        $banco->save();

        return redirect()->route('bancos.show', $banco);
    }

    public function show(Banco $banco)
    {
        return view('banco.show', compact('banco'));
    }

    public function edit(Banco $banco)
    {
        return view('banco.edit', compact('banco'));
    }

    public function update (Banco $banco, StoreBanco $request) {

        $banco->nombre = $request->nombre;

        $banco->save();

        return redirect()->route('bancos.show', $banco);
    }

    public function destroy (Banco $banco) {
        $banco->delete();

        return redirect()->route('bancos.index');
    }
}
