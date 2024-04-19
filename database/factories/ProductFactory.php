<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'image' => fake()->randomElement(['']),
            // 'image' => Storage::disk('local')->put('public/default/default.jpg'),
            // 'image' => fake()->unique()->imageUrl(),
            'price' => fake()->randomFloat(2, 1, 100),
            'stock' => fake()->numberBetween(1, 100),
            'status' => fake()->boolean(),
            'is_favorite' => fake()->boolean(),
            'category_id' => fake()->numberBetween(1, 4),
        ];
    }
}
