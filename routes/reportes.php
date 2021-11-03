<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('pdf', [PDFController::class, 'PDF'])->name('descargarPDF');

Route::get('pdfproductos', [PDFController::class, 'PDFCategorias'])->name('descargarProductos');
