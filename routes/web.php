<?php

//namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorizacionesController;
use App\Http\Controllers\PDFController;
use App\Exports\AutorizacionesExport;

Route::get('/', function () {
    return view('auth.login');
});

/*
Route::get('/autorizaciones', [AutorizacionesController::class, 'index']);
Route::get('/autorizaciones/create', [AutorizacionesController::class, 'create']);

Route::get('/autorizaciones/edit', [AutorizacionesController::class, 'edit']);


Route::get('/autorizaciones/store', [AutorizacionesController::class, 'store']);


Route::get('/autorizaciones/form', [AutorizacionesController::class, 'form']);
*/

//Route::resource('autorizaciones',AutorizacionesController::class);
Route::resource('autorizaciones',AutorizacionesController::class)->middleware('auth');

Auth::routes(['register'=>true,'reset'=>false]);

Route::get('/home', [App\Http\Controllers\AutorizacionesController::class, 'index'])->name('home');
Route::get('/anular/{id}', [App\Http\Controllers\AutorizacionesController::class, 'anular'])->name('anular');
Route::get('/searchdate', [App\Http\Controllers\AutorizacionesController::class, 'searchdate'])->name('searchdate');


Route::get('/pdf/{id}',[App\Http\Controllers\PDFController::class,'PDF'])->name('descargarPDF');
Route::get('/Generador_QR/{QR_cadena}',[App\Http\Controllers\QRController::class,'Generador_QR'])->name('Generador_QR');


