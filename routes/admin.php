<?php

use App\Http\Controllers\Admin\CtrAdministrador;
use App\Http\Controllers\Admin\CtrComunicado;
use App\Http\Controllers\Admin\CtrConfiguracion;
use App\Http\Controllers\Admin\CtrUnidad;
use App\Http\Controllers\Admin\CtrUser;
use Illuminate\Support\Facades\Route;

Route::get('configuracion', CtrConfiguracion::class)->middleware('can:admin.configuracion')->name('admin.configuracion');

Route::resource('administrador', CtrAdministrador::class)->only(['index', 'show'])->names('admin.administrador');

Route::resource('comunicado', CtrComunicado::class)->only('index', 'show')->names('admin.comunicado');

Route::resource('unidad', CtrUnidad::class)->only(['index', 'show'])->names('admin.unidad');

Route::get('usuario', CtrUser::class)->middleware('can:admin.usuario.index')->name('admin.usuario');
