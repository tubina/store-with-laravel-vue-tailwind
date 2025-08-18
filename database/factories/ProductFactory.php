<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
            'name' => fake()->words(7, true),
            'category_id' => DB::table('category')->inRandomOrder()->first()?->id,
            'from_price' => fake()->randomFloat(2, 100000, 150000),
            'price' => fake()->randomFloat(2, 100, 1000),
            'description' => fake()->text(700)
        ];
    }
}
