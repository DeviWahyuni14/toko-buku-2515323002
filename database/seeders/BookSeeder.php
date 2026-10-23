<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'category_id' => 1,
            'title' => 'Belajar PHP dari Nol',
            'author_name' => 'Ni Made Ayu Kartika',
            'price' => 85000,
            'cover_image' => 'buku1.png',
        ]);

        Book::create([
            'category_id' => 1,
            'title' => 'Dasar Pemrograman Berorientasi Objek',
            'author_name' => 'I Wayan Sudiarta',
            'price' => 72000,
            'cover_image' => 'pbo.png',
        ]);

        Book::create([
            'category_id' => 2,
            'title' => 'Tentang Kamu',
            'author_name' => 'Tere Liye',
            'price' => 100000,
            'cover_image' => 'tentang_kamu.png',
        ]);

        Book::create([
            'category_id' => 2,
            'title' => 'Laut Bercerita',
            'author_name' => 'Leila Salikha Chudori',
            'price' => 125000,
            'cover_image' => 'bercerita_karya.png',
        ]);
        Book::create([
            'category_id' => 3,
            'title' => 'Strategi Keuangan untuk Pemula',
            'author_name' => 'Ida Bagus Mantra',
            'price' => 110000,
            'cover_image' => 'keuangan_untuk_pemula.png',
        ]);
         Book::create([
            'category_id' => 3,
            'title' => 'Membaca Laporan Keuangan Sederhana',
            'author_name' => 'Putu Gede Ardika',
            'price' => 98000,
            'cover_image' => 'keuangan_sederhana.png',
        ]);
}
}