<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'category_id' => 1,
            'title' => 'Belajar PHP dari Nol',
            'author_name' => 'Ni Made Ayu Kartika',
            'price' => 85000,
        ]);
        Book::create([
            'category_id' => 1,
            'title' => 'Dasar Pemrograman Berorientasi Objek',
            'author_name' => 'I Wayan Sudiarta',
            'price' => 72000,
        ]);
        Book::create([
            'category_id' => 2,
            'title' => 'Tentang Kamu',
            'author_name' => 'Tere Liye',
            'price' => 100000,
        ]);
        Book::create([
            'category_id' => 2,
            'title' => 'Laut Bercerita',
            'author_name' => 'Leila Salikha Chudori',
            'price' => 125000,
        ]);
        Book::create([
            'category_id' => 3,
            'title' => 'Strategi Keuangan untuk Pemula',
            'author_name' => 'Ida Bagus Mantra',
            'price' => 110000,
        ]);
        Book::create([
            'category_id' => 3,
            'title' => 'Membaca Laporan Keuangan Sederhana',
            'author_name' => 'Putu Gede Ardika',
            'price' => 98000,
        ]);
    }
}