<?php

use App\Http\Controllers\Admin\CtrSancion;
use App\Http\Controllers\Admin\CtrUnidad;
use App\Http\Controllers\CtrBanco;
use App\Http\Controllers\CtrCategoria;
use App\Http\Controllers\CtrCuenta;
use App\Http\Controllers\CtrEnfermedad;
use App\Http\Controllers\CtrFondo;
use App\Http\Controllers\CtrIntegrante;
use App\Http\Controllers\CtrMedicamento;
use App\Http\Controllers\CtrPagoPropietario;
use App\Http\Controllers\CtrProveedor;
use App\Http\Controllers\CtrServicio;
use App\Http\Controllers\CtrTipoUnidad;
use App\Http\Controllers\CtrVisita;
use Illuminate\Support\Facades\Route;

// Reportes de lista
Route::get('banco/exportar', [CtrBanco::class, 'exportar'])->name('banco.exportar');

Route::get('categoria/exportar', [CtrCategoria::class, 'exportar'])->name('categoria.exportar');

Route::get('cuenta/exportar', [CtrCuenta::class, 'exportar'])->name('cuenta.exportar');

Route::get('enfermedad/exportar', [CtrEnfermedad::class, 'exportar'])->name('enfermedad.exportar');

Route::get('habitante/exportar', [CtrIntegrante::class, 'exportar'])->name('habitante.exportar');

Route::get('medicamento/exportar', [CtrMedicamento::class, 'exportar'])->name('medicamento.exportar');

Route::get('proveedor/exportar', [CtrProveedor::class, 'exportar'])->name('proveedor.exportar');

Route::get('sancion/exportar', [CtrSancion::class, 'exportar'])->name('sancion.exportar');

Route::get('servicio/exportar', [CtrServicio::class, 'exportar'])->name('servicio.exportar');

Route::get('tipo-unidad/exportar', [CtrTipoUnidad::class, 'exportar'])->name('tipo-unidad.exportar');


// Reportes parametrizados
Route::get('unidad/exportar/{fitros}', [CtrUnidad::class, 'exportar'])->name('unidad.exportar');

Route::get('visita/exportar/{fitros}', [CtrVisita::class, 'exportar'])->name('visita.exportar');


// Reportes de procesos
Route::get('recibo/{recibo}', [CtrPagoPropietario::class, 'exportarRecibo'])->name('pago-propietario.recibo');

Route::get('fondos/{fondo}/movimientos', [CtrFondo::class, 'exportarMovimientos'])->name('fondo.movimiento');
