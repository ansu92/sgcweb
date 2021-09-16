<?php

use App\Http\Controllers\CtrAsamblea;
use App\Http\Controllers\CtrBanco;
use App\Http\Controllers\CtrCategoria;
use App\Http\Controllers\CtrCierreMes;
use App\Http\Controllers\CtrComunicado;
use App\Http\Controllers\CtrCuenta;
use App\Http\Controllers\CtrFondo;
use App\Http\Controllers\CtrGasto;
use App\Http\Controllers\CtrInicio;
use App\Http\Controllers\CtrIntegrante;
use App\Http\Controllers\CtrPago;
use App\Http\Controllers\CtrPagoPropietario;
use App\Http\Controllers\CtrProveedor;
use App\Http\Controllers\CtrServicio;
use App\Http\Controllers\CtrTipoUnidad;
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

Route::get('asamblea', [CtrAsamblea::class, 'index'])->name('asamblea.index');

Route::get('asamblea/{asamblea}', [CtrAsamblea::class, 'show'])->name('asamblea.show');

Route::resource('banco', CtrBanco::class)->only(['index', 'show'])->names('banco');

Route::get('categoria', [CtrCategoria::class, 'index'])->name('categoria.index');

Route::get('categoria/{categoria}', [CtrCategoria::class, 'show'])->name('categoria.show');

Route::get('cierre-de-mes', CtrCierreMes::class)->name('cierre-mes.index');

Route::resource('comunicado', CtrComunicado::class)->only('index', 'show')->names('comunicado');

Route::get('cuenta', [CtrCuenta::class, 'index'])->name('cuenta.index');

Route::get('cuenta/{cuenta}', [CtrCuenta::class, 'show'])->name('cuenta.show');

Route::resource('fondo', CtrFondo::class)->only(['index', 'show'])->names('fondo');

Route::resource('gasto', CtrGasto::class)->only(['index', 'show'])->names('gasto');

Route::get('integrante/{integrante}', [CtrIntegrante::class, 'show'])->name('integrante.show');

Route::resource('pago-condominio', CtrPago::class)->only(['index', 'create', 'show'])->names('pago');

Route::resource('pago-propietario', CtrPagoPropietario::class)->only(['index', 'create', 'show'])->names('pago-propietario');

Route::resource('proveedor', CtrProveedor::class)->only(['index', 'show'])->names('proveedor');

Route::resource('servicio', CtrServicio::class)->only(['index', 'show'])->names('servicio');

Route::resource('tipo-unidad', CtrTipoUnidad::class)->only(['index', 'show'])->names('tipo-unidad');

Route::get('visita', [CtrVisita::class, 'index'])->name('visita.index');

Route::get('visita/{visita}', [CtrVisita::class, 'show'])->name('visita.show');

Route::get('unidad', [CtrUnidad::class, 'index'])->name('unidad.index');

Route::get('unidad/{unidad}', [CtrUnidad::class, 'show'])->name('unidad.show');
