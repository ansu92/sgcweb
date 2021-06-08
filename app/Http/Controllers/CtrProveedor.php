<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProveedor;
use App\Models\Proveedor;
use Illuminate\Support\Str;

class CtrProveedor extends Controller
{

    public function index(){

        $proveedores = Proveedor::paginate();
        return view('proveedor.index', compact('proveedores'));
    }

    public function store (StoreProveedor $request) {

        $proveedor = new Proveedor();

        $proveedor->nombre = $request->nombre;
        $proveedor->slug = Str::slug($proveedor->nombre);

        $proveedor->save();

        return redirect()->route('proveedores.show', $proveedor);
    }

    public function show (Proveedor $proveedor) {
    	return view('proveedor.show', compact('proveedor'));
    }

    public function edit (Proveedor $proveedor) {
        return view('proveedor.edit', compact('proveedor'));
    }

    public function update (Proveedor $proveedor, StoreProveedor $request) {

        $proveedor->nombre = $request->nombre;

        $proveedor->save();

        return redirect()->route('proveedores.show', $proveedor);
    }

    public function destroy (Proveedor $proveedor) {
        $proveedor->delete();

        return redirect()->route('proveedores.index');
    }

}
