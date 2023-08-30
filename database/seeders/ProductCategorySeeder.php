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
            ['id' => 1, 'name' => 'PP Automotive Batteries'],
            ['id' => 2, 'name' => 'MF Automotive Batteries'],
            ['id' => 3, 'name' => 'Solar'],
            ['id' => 4, 'name' => 'Inverter'],
            ['id' => 5, 'name' => 'Battery Terminals'],
        ];
        foreach ($categories as $category) {
            ProductCategory::query()->create($category);
        }
    }
}
