<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/buat-tabungan', [App\Http\Controllers\HomeController::class, 'buattabungan'])->name('buat-tabungan');
Route::put('/edit-tabungan/{id}', [App\Http\Controllers\HomeController::class, 'edittabungan'])->name('edit-tabungan');
Route::delete('/hapus-tabungan/{id}', [App\Http\Controllers\HomeController::class, 'hapustabungan'])->name('hapus-tabungan');
Route::put('/menabung/{id}', [App\Http\Controllers\HomeController::class, 'menabung'])->name('menabung');


