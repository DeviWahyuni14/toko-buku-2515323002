<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute Buku (PENTING: 'create' HARUS sebelum '{buku}')
Route::get('/buku', [BookController::class, 'index'])->name('buku.index');
Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
Route::post('/buku', [BookController::class, 'store'])->name('buku.store');
Route::get('/buku/{buku}', [BookController::class, 'show'])->name('buku.show');
Route::get('/buku/{buku}/edit', [BookController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{buku}', [BookController::class, 'update'])->name('buku.update');
Route::delete('/buku/{buku}', [BookController::class, 'destroy'])->name('buku.destroy');

// Tambahkan rute penjelas nama agar navbar tidak error
Route::get('/kategori', function () {
    return redirect('/buku');
})->name('kategori.index');

Route::get('/penerbit', function () {
    return redirect('/buku');
})->name('penerbit.index');