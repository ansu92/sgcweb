<?php

use App\Http\Controllers\CtrAsamblea;
use App\Http\Controllers\CtrBanco;
use App\Http\Controllers\CtrCategoria;
use App\Http\Controllers\CtrCuenta;
use App\Http\Controllers\CtrConfiguracion;
use App\Http\Controllers\CtrFondo;
use App\Http\Controllers\CtrGasto;
use App\Http\Controllers\CtrIntegrante;
use App\Http\Controllers\CtrProveedor;
use App\Http\Controllers\CtrServicio;
use App\Http\Controllers\CtrTipoUnidad;
use App\Http\Controllers\CtrTipoUsuario;
use App\Http\Controllers\CtrUnidad;
use App\Http\Controllers\CtrUser;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('configuracion', CtrConfiguracion::class)->name('configuracion');

Route::get('categoria', [CtrCategoria::class, 'index'])->name('categoria.index');

Route::get('categoria/{categoria}', [CtrCategoria::class, 'show'])->name('categoria.show');

Route::get('proveedor', [CtrProveedor::class, 'index'])->name('proveedor.index');

Route::get('proveedor/{proveedor}', [CtrProveedor::class, 'show'])->name('proveedor.show');

Route::get('unidad', [CtrUnidad::class, 'index'])->name('unidad.index');

Route::get('unidad/{unidad}', [CtrUnidad::class, 'show'])->name('unidad.show');

Route::get('usuario', CtrUser::class)->name('usuario');

Route::get('integrante/{integrante}', [CtrIntegrante::class, 'show'])->name('integrante.show');

Route::get('cuenta', [CtrCuenta::class, 'index'])->name('cuenta.index');

Route::get('cuenta/{cuenta}', [CtrCuenta::class, 'show'])->name('cuenta.show');

Route::get('banco', [CtrBanco::class, 'index'])->name('banco.index');

Route::get('banco/{banco}', [CtrBanco::class, 'show'])->name('banco.show');

Route::get('tipo-unidad', [CtrTipoUnidad::class, 'index'])->name('tipo-unidad.index');

Route::get('tipo-unidad/{tipoUnidad}', [CtrTipoUnidad::class, 'show'])->name('tipo-unidad.show');

Route::get('tipo-usuario', [CtrTipoUsuario::class, 'index'])->name('tipo-usuario.index');

Route::get('tipo-usuario/{tipoUsuario}', [CtrTipoUsuario::class, 'show'])->name('tipo-usuario.show');

Route::get('fondo', [CtrFondo::class, 'index'])->name('fondo.index');

Route::get('fondo/{fondo}', [CtrFondo::class, 'show'])->name('fondo.show');

Route::get('asamblea', [CtrAsamblea::class, 'index'])->name('asamblea.index');

Route::get('asamblea/{asamblea}', [CtrAsamblea::class, 'show'])->name('asamblea.show');

Route::get('servicio', [CtrServicio::class, 'index'])->name('servicio.index');

Route::get('servicio/{servicio}', [CtrServicio::class, 'show'])->name('servicio.show');

Route::get('gasto', [CtrGasto::class, 'index'])->name('gasto.index');

Route::get('gasto/{gasto}', [CtrGasto::class, 'show'])->name('gasto.show');

Route::get('visita', [CtrVisita::class, 'index'])->name('visita.index');

Route::get('visita/{visita}', [CtrVisita::class, 'show'])->name('visita.show');


