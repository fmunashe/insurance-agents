<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'KSH', 'rate' => 1],
            ['name' => 'USD', 'rate' => 1],
            ['name' => 'ZWL', 'rate' => 5000],
            ['name' => 'ZAR', 'rate' => 18],
        ];
        foreach ($currencies as $currency) {
            Currency::query()->create($currency);
        }
    }
}
