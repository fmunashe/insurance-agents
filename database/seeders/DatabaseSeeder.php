<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SupplierSeeder::class);

    }
}
