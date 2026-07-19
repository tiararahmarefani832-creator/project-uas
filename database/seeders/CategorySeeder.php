<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Pengumuman']);
        Category::create(['name' => 'Kegiatan']);
        Category::create(['name' => 'Prestasi']);
        category::create(['name' => 'Beasiswa']);
    }
}
