<?php

use App\Http\Controllers\Admin\CtrAdministrador;
use App\Http\Controllers\Admin\CtrComunicado;
use App\Http\Controllers\Admin\CtrCondominio;
use App\Http\Controllers\Admin\CtrInicio;
use App\Http\Controllers\Admin\CtrSancion;
use App\Http\Controllers\Admin\CtrUnidad;
use App\Http\Controllers\Admin\CtrUser;
use Illuminate\Support\Facades\Route;

Route::get('/', CtrInicio::class)->middleware('can:admin')->name('admin');

Route::resource('administrador', CtrAdministrador::class)->only(['index', 'show'])->names('admin.administrador');

Route::get('condominio', [CtrCondominio::class, 'index'])->name('admin.condominio');

Route::post('condominio', [CtrCondominio::class, 'store'])->name('admin.condominio.store');

Route::resource('comunicado', CtrComunicado::class)->only('index', 'show')->names('admin.comunicado');

Route::resource('sancion', CtrSancion::class)->only(['index', 'show'])->names('admin.sancion');

Route::resource('unidad', CtrUnidad::class)->only(['index', 'show'])->names('admin.unidad');

Route::get('usuario', [CtrUser::class, 'index'])->middleware('can:admin.usuario.index')->name('admin.usuario.index');

Route::get('usuario/{usuario}', [CtrUser::class, 'show'])->middleware('can:admin.usuario.show')->name('admin.usuario.show');
