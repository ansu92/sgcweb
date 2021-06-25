<?php

use App\Http\Controllers\CtrBanco;
use App\Http\Controllers\CtrCategoria;
use App\Http\Controllers\CtrCuenta;
use App\Http\Controllers\CtrConfiguracion;
use App\Http\Controllers\CtrIntegrante;
use App\Http\Controllers\CtrProveedor;
use App\Http\Controllers\CtrTipoUnidad;
use App\Http\Controllers\CtrTipoUsuario;
use App\Http\Controllers\CtrUnidad;
use App\Http\Controllers\CtrUser;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('configuracion', CtrConfiguracion::class)->name('configuracion');

Route::resource('banco', CtrBanco::class);

Route::get('categoria', [CtrCategoria::class, 'index'])->name('categoria.index');

Route::get('categoria/{categoria}', [CtrCategoria::class, 'show'])->name('categoria.show');

Route::resource('cuenta', CtrCuenta::class);

Route::resource('tipo-unidad', CtrTipoUnidad::class);

Route::resource('tipo-usuario', CtrTipoUsuario::class);

Route::resource('proveedor', CtrProveedor::class);

Route::get('unidad', [CtrUnidad::class, 'index'])->name('unidad.index');

Route::get('unidad/{unidad}', [CtrUnidad::class, 'show'])->name('unidad.show');

Route::get('usuario', CtrUser::class)->name('usuario');

Route::get('integrante/{integrante}', [CtrIntegrante::class, 'show'])->name('integrante.show');
