<?php

use App\Http\Controllers\CtrAdministrador;
use App\Http\Controllers\CtrAsamblea;
use App\Http\Controllers\CtrComunicado;
use App\Http\Controllers\CtrCuenta;
use App\Http\Controllers\CtrFondo;
use App\Http\Controllers\CtrGasto;
use App\Http\Controllers\CtrInicio;
use App\Http\Controllers\CtrIntegrante;
use App\Http\Controllers\CtrPago;
use App\Http\Controllers\CtrProveedor;
use App\Http\Controllers\CtrUnidad;
use App\Http\Controllers\CtrVisita;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', CtrInicio::class)->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('proveedor', [CtrProveedor::class, 'index'])->name('proveedor.index');

Route::get('proveedor/{proveedor}', [CtrProveedor::class, 'show'])->name('proveedor.show');

Route::get('integrante/{integrante}', [CtrIntegrante::class, 'show'])->name('integrante.show');

Route::get('cuenta', [CtrCuenta::class, 'index'])->name('cuenta.index');

Route::get('cuenta/{cuenta}', [CtrCuenta::class, 'show'])->name('cuenta.show');

Route::get('fondo', [CtrFondo::class, 'index'])->name('fondo.index');

Route::get('fondo/{fondo}', [CtrFondo::class, 'show'])->name('fondo.show');

Route::get('asamblea', [CtrAsamblea::class, 'index'])->name('asamblea.index');

Route::get('asamblea/{asamblea}', [CtrAsamblea::class, 'show'])->name('asamblea.show');

Route::get('gasto', [CtrGasto::class, 'index'])->name('gasto.index');

Route::get('gasto/{gasto}', [CtrGasto::class, 'show'])->name('gasto.show');

Route::get('visita', [CtrVisita::class, 'index'])->name('visita.index');

Route::get('visita/{visita}', [CtrVisita::class, 'show'])->name('visita.show');

Route::get('administrador', [CtrAdministrador::class, 'index'])->name('administrador.index');

Route::get('administrador/{administrador}', [CtrAdministrador::class, 'show'])->name('administrador.show');

Route::get('comunicado', [CtrComunicado::class, 'index'])->name('comunicado.index');

Route::get('comunicado/{comunicado}', [CtrComunicado::class, 'comunicado.show'])->name('comunicado.show');

Route::get('unidad/{unidad}', CtrUnidad::class)->name('unidad.show');
