<?php
// routes/web.php

use App\Http\Controllers\ArchivoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArchivoController::class, 'index']);
Route::get('archivos/table', [ArchivoController::class, 'table'])->name('archivos.table');
Route::resource('archivos', ArchivoController::class);
Route::get('archivos/{id}', [ArchivoController::class, 'show'])->name('archivos.show');