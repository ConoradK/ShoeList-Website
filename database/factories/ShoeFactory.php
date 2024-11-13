<?php

namespace Database\Factories;

use App\Models\Shoe;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoeFactory extends Factory
{
    // Define the model that the factory will generate instances of
    protected $model = Shoe::class;

    // Define the default set of attributes for the Shoe model
    public function definition()
    {
        // Retrieve shoe attributes from the configuration file (config/shoeAttributes.php)
        $shoeAttributes = config('shoeAttributes');

        return [
            // Generate a random name for the shoe, and capitalise the first letter
            'name' => ucfirst($this->faker->word()),

            // Randomly pick a brand from the brands list defined in the configuration
            'brand' => $this->faker->randomElement($shoeAttributes['brands']),

            // Randomly pick a type from the types list defined in the configuration
            'type' => $this->faker->randomElement($shoeAttributes['types']),

            // Randomly pick a material from the materials list defined in the configuration
            'material' => $this->faker->randomElement($shoeAttributes['materials']),

            // Generate a random price between 50 and 1000 with two decimal places
            'price' => $this->faker->randomFloat(2, 50, 1000),

            // Generate a random color name and capitalise the first letter
            'colour' => ucfirst($this->faker->safeColorName()),

            // Generate a random stock quantity between 1 and 100
            'stock' => $this->faker->numberBetween(1, 100),

            // Generate a random release date for the shoe
            'release_date' => $this->faker->date(),
        ];
    }
}
