<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        // Retrieve the materials list from the shoeAttributes config and insert them into the database
        $materials = config('shoeAttributes.materials');

        foreach ($materials as $material) {
            Material::create(['name' => $material]);
        }
    }
}
