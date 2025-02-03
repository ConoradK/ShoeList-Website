<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        // Retrieve the brands list from the shoeAttributes config and insert them into the database
        $brands = config('shoeAttributes.brands');

        foreach ($brands as $brand) {
            Brand::create(['name' => $brand]);
        }
    }
}
