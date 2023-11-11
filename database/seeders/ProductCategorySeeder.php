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
            ['id' => 1, 'name' => 'Vehicles'],
            ['id' => 2, 'name' => 'Residential'],
            ['id' => 3, 'name' => 'Industrial'],
            ['id' => 4, 'name' => 'Domestic'],
        ];
        ProductCategory::query()->delete();
        foreach ($categories as $category) {
            ProductCategory::query()->create($category);
        }
    }
}
