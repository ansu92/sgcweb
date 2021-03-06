<?php

use App\Http\Controllers\CtrAplicarSancion;
use App\Http\Controllers\CtrAsamblea;
use App\Http\Controllers\CtrBanco;
use App\Http\Controllers\CtrCategoria;
use App\Http\Controllers\CtrCierreMes;
use App\Http\Controllers\CtrComunicado;
use App\Http\Controllers\CtrCuenta;
use App\Http\Controllers\CtrEnfermedad;
use App\Http\Controllers\CtrFactura;
use App\Http\Controllers\CtrFondo;
use App\Http\Controllers\CtrGasto;
use App\Http\Controllers\CtrInicio;
use App\Http\Controllers\CtrIntegrante;
use App\Http\Controllers\CtrMedicamento;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('asamblea', [CtrAsamblea::class, 'index'])->middleware('can:asamblea.index')->name('asamblea.index');

Route::get('asamblea/{asamblea}', [CtrAsamblea::class, 'show'])->middleware('can:asamblea.show')->name('asamblea.show');

Route::resource('banco', CtrBanco::class)->only(['index', 'show'])->names('banco');

Route::get('categoria', [CtrCategoria::class, 'index'])->middleware('can:categoria.index')->name('categoria.index');

Route::get('categoria/{categoria}', [CtrCategoria::class, 'show'])->middleware('can:categoria.show')->name('categoria.show');

Route::get('cierre-de-mes', CtrCierreMes::class)->middleware('can:cierre-mes.index')->name('cierre-mes.index');

Route::resource('comunicado', CtrComunicado::class)->only('index', 'show')->names('comunicado');

Route::get('cuenta', [CtrCuenta::class, 'index'])->middleware('can:cuenta.index')->name('cuenta.index');

Route::get('cuenta/{cuenta}', [CtrCuenta::class, 'show'])->middleware('can:cuenta.show')->name('cuenta.show');

Route::resource('enfermedad', CtrEnfermedad::class)->only('index', 'show')->names('enfermedad');

Route::get('factura/{factura}', [CtrFactura::class, 'show'])->name('factura.show');

Route::resource('fondo', CtrFondo::class)->only(['index', 'show'])->names('fondo');

Route::resource('gasto', CtrGasto::class)->only(['index', 'show'])->names('gasto');

Route::get('integrante/{integrante}', [CtrIntegrante::class, 'show'])->middleware('can:integrante.show')->name('integrante.show');

Route::resource('medicamento', CtrMedicamento::class)->only('index', 'show')->names('medicamento');

Route::resource('pago-condominio', CtrPago::class)->only(['index', 'create', 'show'])->names('pago');

Route::resource('pago-propietario', CtrPagoPropietario::class)->only(['index', 'create', 'show'])->names('pago-propietario');

Route::get('confirmar-pagos', [CtrPagoPropietario::class, 'confirmar'])->name('pago.confirmar');

Route::resource('proveedor', CtrProveedor::class)->only(['index', 'show'])->names('proveedor');

Route::get('aplicar-sancion', [CtrAplicarSancion::class, 'index'])->middleware('can:sancion.aplicar')->name('aplicar-sancion.index');

Route::resource('servicio', CtrServicio::class)->only(['index', 'show'])->names('servicio');

Route::resource('tipo-unidad', CtrTipoUnidad::class)->only(['index', 'show'])->names('tipo-unidad');

Route::get('visita', [CtrVisita::class, 'index'])->middleware('can:visita.index')->name('visita.index');

Route::get('visita/{visita}', [CtrVisita::class, 'show'])->middleware('can:visita.show')->name('visita.show');

Route::get('visita/lista', [CtrVisita::class, 'lista'])->middleware('can:visita.lista')->name('visita.lista');

Route::get('unidad', [CtrUnidad::class, 'index'])->middleware('can:unidad.index')->name('unidad.index');

Route::get('unidad/{unidad}', [CtrUnidad::class, 'show'])->middleware('can:unidad.show')->name('unidad.show');

Route::view('nosotros', 'nosotros.index')->withoutMiddleware(['auth:sanctum', 'verified'])->name('nosotros.index');
