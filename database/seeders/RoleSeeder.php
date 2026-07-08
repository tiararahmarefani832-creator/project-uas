<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Category;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
      
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        Category::create(['name' => '#Pengumuman']);
        Category::create(['name' => '#Kegiatan']);
        Category::create(['name' => '#Prestasi']);
        category::create(['name' => 'Beasiswa']);
    }
}