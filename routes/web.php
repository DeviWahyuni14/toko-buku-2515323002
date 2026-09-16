<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BookController::class, 'index']);

Route::get('/buku/{id}', [BookController::class, 'show']);