<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route Buku (Pertemuan 4)
Route::get('/buku', [BookController::class, 'index']);
Route::get('/buku/{id}', [BookController::class, 'show']);

// Route Kategori (Pertemuan 5)
Route::resource('kategori', CategoryController::class)
    ->except('show');

// Route Penerbit (Tugas Mandiri)
Route::resource('penerbit', PublisherController::class)
    ->except('show');