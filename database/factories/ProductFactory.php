<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $categories = ProductCategory::query()->pluck('id')->toArray();
        $clients = Client::query()->pluck('id')->toArray();
        return [
            'product_category_id' => $this->faker->randomElement($categories),
            'client_id' => $this->faker->randomElement($clients),
            'name' => $this->faker->colorName(),
            'description' => $this->faker->sentence()
        ];
    }
}
