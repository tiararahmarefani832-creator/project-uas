<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Pengumuman']);
        Category::firstOrCreate(['name' => 'Kegiatan']);
        Category::firstOrCreate(['name' => 'Prestasi']);
        Category::firstOrCreate(['name' => 'Beasiswa']); 
    }
}