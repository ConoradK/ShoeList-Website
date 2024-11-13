<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Shoe;

class ShoeSeeder extends Seeder
{
    public function run()
    {

        // Truncate the table to reset auto-increment
        \DB::table('shoes')->truncate();
        // Using factory to generate 500 random shoes
        Shoe::factory(500)->create();
    }
}
