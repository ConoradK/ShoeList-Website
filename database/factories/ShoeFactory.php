<?php

namespace Database\Factories;

use App\Models\Shoe;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoeFactory extends Factory
{
    // Define the model associated with the factory
    protected $model = Shoe::class;

    // Define the default state of the Shoe model
    public function definition()
    {
        return [
            // Generate a random shoe name with the first letter capitalized
            'name' => ucfirst($this->faker->word()),
            // Get a random brand ID from the database
            'brand_id' => Brand::inRandomOrder()->first()->id,
            // Get a random type ID from the database
            'type_id' => Type::inRandomOrder()->first()->id,
            // Generate a random price between 50 and 1000 with two decimal places
            'price' => $this->faker->randomFloat(2, 50, 1000),
            // Generate a random stock quantity between 1 and 100
            'stock' => $this->faker->numberBetween(1, 100),
            // Generate a random release date
            'release_date' => $this->faker->date(),
        ];
    }
}
