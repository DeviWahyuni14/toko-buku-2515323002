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
            'title' => 'Senja di Pelabuhan Kecil',
            'author_name' => 'Made Dwijendra',
            'price' => 68000,
        ]);
        Book::create([
            'category_id' => 2,
            'title' => 'Jalan Pulang ke Desa',
            'author_name' => 'Ni Luh Putu Sari',
            'price' => 64000,
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