<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run()
    {
        $types = config('shoeAttributes.types');

        foreach ($types as $type) {
            Type::create(['name' => $type]);
        }
    }
}
