<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // First, seed the reference data
        $this->call([
            BrandSeeder::class,
            TypeSeeder::class,
            ColourSeeder::class,
            MaterialSeeder::class,
            UserSeeder::class
        ]);

        // Then, seed the shoes
        $this->call(ShoeSeeder::class);
    }
}
