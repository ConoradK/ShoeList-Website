<?php

namespace Database\Seeders;

use App\Models\Shoe;
use App\Models\Colour;
use App\Models\Material;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class ShoeSeeder extends Seeder
{
    public function run()
    {
        // Seed the shoes first
        $shoes = Shoe::factory(500)->create();

        // Attach up to 3 random colours and 2 random materials to each shoe
        $shoes->each(function ($shoe) {
            // Attach 1 to 3 random colours from the colours table
            $colours = Colour::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $shoe->colours()->attach($colours);

            // Attach 1 to 2 random materials from the materials table
            $materials = Material::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $shoe->materials()->attach($materials);
        });
    }
}
