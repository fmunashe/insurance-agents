<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['id' => 1, 'name' => 'Monthly', 'amount' => 75.0, 'stripe_key' => 'price_1OE9RXGytOIEXXD1JzZDLSJi'],
            ['id' => 2, 'name' => 'Quarterly', 'amount' => 320.0, 'stripe_key' => 'price_1OE9RXGytOIEXXD1JzZDLSJi'],
            ['id' => 3, 'name' => 'Bi-Annual', 'amount' => 400.0, 'stripe_key' => 'price_1OE9RXGytOIEXXD1JzZDLSJi'],
            ['id' => 4, 'name' => 'Annual', 'amount' => 600.0, 'stripe_key' => 'price_1OE9RXGytOIEXXD1JzZDLSJi']
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::query()->updateOrCreate($plan, $plan);
        }
    }
}
