<?php

namespace Database\Factories;

use App\Models\Shoe;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoeFactory extends Factory
{
    protected $model = Shoe::class;

    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->word()),
            'brand_id' => Brand::inRandomOrder()->first()->id,  // Get random brand ID
            'type_id' => Type::inRandomOrder()->first()->id,    // Get random type ID
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'release_date' => $this->faker->date(),
        ];
    }
}
