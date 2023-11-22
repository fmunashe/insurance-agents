<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            ['id' => 1, 'name' => 'Vehicles', 'user_id' => 1],
            ['id' => 2, 'name' => 'Residential', 'user_id' => 1],
            ['id' => 3, 'name' => 'Industrial', 'user_id' => 1],
            ['id' => 4, 'name' => 'Domestic', 'user_id' => 1],
        ];
        ProductCategory::query()->delete();
        foreach ($categories as $category) {
            ProductCategory::query()->create($category);
        }
    }
}
