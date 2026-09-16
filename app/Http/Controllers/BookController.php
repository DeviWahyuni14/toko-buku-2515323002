<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
    private array $daftarBuku = [
        1 => [
            'judul' => 'Belajar PHP dari Nol',
            'penulis' => 'Devi Wahyuni'
        ],
        2 => [
            'judul' => 'Dasar Pemrograman Berorientasi Objek',
            'penulis' => 'Jessica Rahayu'
        ],
        3 => [
            'judul' => 'Pengantar Basis Data',
            'penulis' => 'Dina Antari'
        ],
    ];

    public function index()
    {
        return view('buku.index', [
            'daftarBuku' => $this->daftarBuku
        ]);
    }

    public function show($id)
    {
        $buku = $this->daftarBuku[$id] ?? null;

        return view('buku.show', [
            'buku' => $buku,
            'id' => $id
        ]);
    }
}