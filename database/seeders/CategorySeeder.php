<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Pemrograman'
        ]);

        Category::create([
            'name' => 'Novel'
        ]);

        Category::create([
            'name' => 'Bisnis & Keuangan'
        ]);
    }
}