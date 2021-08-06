<?php

use App\Http\Controllers\Admin\CtrBanco;
use App\Http\Controllers\Admin\CtrCategoria;
use App\Http\Controllers\Admin\CtrConfiguracion;
use App\Http\Controllers\Admin\CtrPago;
use App\Http\Controllers\Admin\CtrServicio;
use App\Http\Controllers\Admin\CtrTipoUnidad;
use App\Http\Controllers\Admin\CtrUnidad;
use App\Http\Controllers\Admin\CtrUser;
use Illuminate\Support\Facades\Route;

Route::get('configuracion', CtrConfiguracion::class)->middleware('can:admin.configuracion')->name('admin.configuracion');

Route::resource('banco', CtrBanco::class)->only(['index', 'show'])->names('admin.banco');

Route::resource('categoria', CtrCategoria::class)->only(['index', 'show'])->names('admin.categoria');

Route::resource('servicio', CtrServicio::class)->only(['index', 'show'])->names('admin.servicio');

Route::resource('tipo-unidad', CtrTipoUnidad::class)->only(['index', 'show'])->names('admin.tipo-unidad');

Route::resource('unidad', CtrUnidad::class)->only(['index', 'show'])->names('admin.unidad');

Route::resource('pago', CtrPago::class)->only(['index', 'show'])->names('admin.pago');

Route::get('usuario', CtrUser::class)->name('admin.usuario');
