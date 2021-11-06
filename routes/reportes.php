<?php

use App\Http\Controllers\Admin\CtrUnidad;
use App\Http\Controllers\CtrBanco;
use App\Http\Controllers\CtrCategoria;
use App\Http\Controllers\CtrCuenta;
use App\Http\Controllers\CtrEnfermedad;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('banco/exportar', [CtrBanco::class, 'exportar'])->name('banco.exportar');

Route::get('categoria/exportar', [CtrCategoria::class, 'exportar'])->name('categoria.exportar');

Route::get('cuenta/exportar', [CtrCuenta::class, 'exportar'])->name('cuenta.exportar');

Route::get('enfermedad/exportar', [CtrEnfermedad::class, 'exportar'])->name('enfermedad.exportar');

Route::get('unidades-con-propietario/exportar', [CtrUnidad::class, 'exportarConPropietario'])->name('unidad.exportar-con-propietario');

Route::get('unidades-sin-propietario/exportar', [CtrUnidad::class, 'exportarSinPropietario'])->name('unidad.exportar-sin-propietario');

Route::get('unidades-con-habitantes/exportar', [CtrUnidad::class, 'exportarConHabitantes'])->name('unidad.exportar-con-habitantes');

Route::get('unidades-sin-habitantes/exportar', [CtrUnidad::class, 'exportarSinHabitantes'])->name('unidad.exportar-sin-habitantes');
