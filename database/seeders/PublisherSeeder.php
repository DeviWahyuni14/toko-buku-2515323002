<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('publishers')->insert([
            ['name' => 'Pustaka Nusantara', 'city' => 'Denpasar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cakrawala Media', 'city' => 'Jakarta', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bumi Aksara Mandiri', 'city' => 'Bandung', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}