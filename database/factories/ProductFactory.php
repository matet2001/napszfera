<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        // Define dynamic attributes for the product
        return [
            'name' => $this->faker->word,
            'description' => null,
            'price' => 1000,
            'image' => '',  // Will be set dynamically
            'type' => 'meditation',
        ];
    }
}
