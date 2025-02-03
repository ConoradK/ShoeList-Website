<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    // Run the database seeds
    public function run()
    {
        // Get the list of shoe types from the configuration
        $types = config('shoeAttributes.types');

        // Loop through each type and create a new Type record in the database
        foreach ($types as $type) {
            Type::create(['name' => $type]);
        }
    }
}
