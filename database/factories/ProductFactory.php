<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['meditation', 'audiobook', 'lecture'];

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(0, 1000, 20000),
            'sku' => strtoupper(Str::random(8)),
            'image' => $this->faker->imageUrl(),
            'type' => $this->faker->randomElement($types),
        ];
    }
}
