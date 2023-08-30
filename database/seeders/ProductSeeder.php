<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['product_category_id' => 1, 'name' => '615PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '616PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '622PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '623PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '628PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '629PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '630PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '631PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '638PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '639PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '646PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '650PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '651PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '652PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '653PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '657PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '658PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '668PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '669PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '671PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '674PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '683PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '689PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 1, 'name' => '690PP', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '616MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '622MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '623MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '628MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '631MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '638MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '639MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '650MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '652MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '653MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '657MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '658MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '66MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '669MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '671MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '674MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '683MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '689MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 2, 'name' => '690MF', 'description' => 'Automotive Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '28AH', 'description' => 'Solar Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '50AH', 'description' => 'Solar Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '80AH', 'description' => 'Solar Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '120AH', 'description' => 'Solar Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '150AH', 'description' => 'Solar Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '200AH', 'description' => 'Solar Battery', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '100W', 'description' => 'Solar Panel', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '150W', 'description' => 'Solar Panel', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '160W', 'description' => 'Solar Panel', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '180W', 'description' => 'Solar Panel', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '300W', 'description' => 'Solar Panel', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '350W', 'description' => 'Solar Panel', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '450W', 'description' => 'Solar Panel', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '10AMP', 'description' => 'Solar Controller', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '20AMP', 'description' => 'Solar Controller', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '30AMP', 'description' => 'Solar Controller', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '40AMP', 'description' => 'Solar Controller', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '50AMP', 'description' => 'Solar Controller', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '60AMP', 'description' => 'Solar Controller', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 3, 'name' => '80MPPT', 'description' => 'Solar Controller', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 4, 'name' => '300VA', 'description' => 'Solar Inverter', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 4, 'name' => '600VA', 'description' => 'Solar Inverter', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 4, 'name' => '900VA', 'description' => 'Solar Inverter', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 4, 'name' => '1.2KVA', 'description' => 'Solar Inverter', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 4, 'name' => '2.0KVA', 'description' => 'Solar Inverter', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 4, 'name' => '3.0KVA', 'description' => 'Solar Inverter', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 4, 'name' => '5.0KVA', 'description' => 'Solar Inverter', 'quantity' => 0, 'price' => 0],
            ['product_category_id' => 5, 'name' => 'NFTERM', 'description' => 'Battery Terminals', 'quantity' => 0, 'price' => 0],
        ];

        foreach ($products as $product) {
            Product::query()->create($product);
        }
    }
}
