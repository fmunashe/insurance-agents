<?php

namespace App\Traits;

use App\Enum\Role;
use App\Models\Client;
use App\Models\Insured;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use SaKanjo\EasyMetrics\Metrics\Doughnut;
use SaKanjo\EasyMetrics\Metrics\Value;

trait Analytics
{
    public function totalUsers(): float
    {
        return Value::make(User::class)
            ->count();
    }

    public function totalClients(): float
    {
        return Value::make(Client::class)
            ->count();
    }

    public function totalProducts(): float
    {
        return Value::make(Product::class)
            ->count();
    }

    public function totalProductCategories(): float
    {
        return Value::make(ProductCategory::class)
            ->count();
    }

    public function productsByCategory()
    {
        return Product::query()
            ->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
            ->selectRaw('product_categories.name as category, COUNT(products.id) as count')
            ->groupBy('category')
            ->get();
    }

    public function policyByProvider()
    {
        return Insured::query()
            ->join('suppliers', 'suppliers.id', '=', 'insureds.supplier_id')
            ->selectRaw('suppliers.name as provider, COUNT(insureds.id) as count')
            ->groupBy('provider')
            ->get();
    }


    public function roles()
    {
        return Doughnut::make(User::class)
            ->count('role');
    }

    public function trend()
    {
        [$labels, $data] = Doughnut::make(User::class)
            ->options(Role::ROLES)
            ->count('role');
        return $data;
        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
