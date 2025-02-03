<?php

namespace Database\Seeders;

use App\Models\Colour;
use Illuminate\Database\Seeder;

class ColourSeeder extends Seeder
{
    public function run()
    {
        // Retrieve the colours list from the shoeAttributes config and insert them into the database
        $colours = config('shoeAttributes.colours');

        foreach ($colours as $colour) {
            Colour::create(['name' => $colour]);
        }
    }
}
