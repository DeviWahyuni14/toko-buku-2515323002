<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return view('buku.index', [
            'daftarBuku' => Book::with('category')->get(),
        ]);
    }

    public function show($id)
    {
        $buku = Book::with('category')->find($id);

        return view('buku.show', [
            'buku' => $buku,
            'id' => $id,
        ]);
    }
}