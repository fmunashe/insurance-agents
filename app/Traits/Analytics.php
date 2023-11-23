<?php

namespace App\Traits;

use App\Enum\Role;
use App\Models\Client;
use App\Models\Insured;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Carbon\Carbon;
use SaKanjo\EasyMetrics\Metrics\Doughnut;
use SaKanjo\EasyMetrics\Metrics\Value;

trait Analytics
{
    public function totalUsers(): float
    {
        $totalUsers = 1;
        if (auth()->user()->role == Role::ROLES[0]) {
            $totalUsers = User::query()
                ->count('id');
        }
        return $totalUsers;
    }

    public function totalClients(): float
    {
        $totalClients = Client::query()
            ->where('user_id', '=', auth()->user()->id)
            ->count('id');
        if (auth()->user()->role == Role::ROLES[0]) {
            $totalClients = Client::query()
                ->count('id');
        }
        return $totalClients;

    }

    public function totalProducts(): float
    {

        if (auth()->user()->role == Role::ROLES[0]) {
            return Value::make(Product::class)
                ->count();
        }
        return Product::query()
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->count('products.id');
    }

    public function totalProductCategories(): float
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Value::make(ProductCategory::class)
                ->count();
        }
        return ProductCategory::query()->where('user_id', '=', auth()->user()->id)->count();
    }

    public function productsByCategory(): \Illuminate\Database\Eloquent\Collection|array
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Product::query()
                ->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                ->selectRaw('product_categories.name as category, COUNT(products.id) as count')
                ->groupBy('category')
                ->get();
        }
        return Product::query()
            ->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->where('product_categories.user_id', '=', auth()->user()->id)
            ->selectRaw('product_categories.name as category, COUNT(products.id) as count')
            ->groupBy('category')
            ->get();
    }

    public function policyByProvider(): \Illuminate\Database\Eloquent\Collection|array
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Insured::query()
                ->join('suppliers', 'suppliers.id', '=', 'insureds.supplier_id')
                ->selectRaw('suppliers.name as provider, COUNT(insureds.id) as count')
                ->groupBy('provider')
                ->get();
        }
        return Insured::query()
            ->join('suppliers', 'suppliers.id', '=', 'insureds.supplier_id')
            ->join('products', 'products.id', '=', 'insureds.product_id')
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->where('suppliers.user_id', '=', auth()->user()->id)
            ->selectRaw('suppliers.name as provider, COUNT(insureds.id) as count')
            ->groupBy('provider')
            ->get();

    }

    public function policiesExpiringThisMonth(): int
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Insured::query()
                ->whereBetween('end_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->count('id');
        }
        return Insured::query()
            ->join('products', 'products.id', '=', 'insureds.product_id')
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->whereBetween('end_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count('insureds.id');
    }

    public function totalPremium()
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Insured::query()
                ->where('status', '=', 1)
                ->sum('premium');
        }
        return Insured::query()
            ->join('products', 'products.id', '=', 'insureds.product_id')
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->where('status', '=', 1)
            ->sum('premium');
    }

    public function totalCommission()
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Insured::query()
                ->where('status', '=', 1)
                ->sum('commission_amount');
        }
        return Insured::query()
            ->join('products', 'products.id', '=', 'insureds.product_id')
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->where('status', '=', 1)
            ->sum('commission_amount');
    }


    public function commissionByRiskCategory(): \Illuminate\Database\Eloquent\Collection|array
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Insured::query()
                ->join('commissions', 'commissions.id', '=', 'insureds.commission_id')
                ->join('product_categories', 'product_categories.id', '=', 'commissions.product_category_id')
                ->selectRaw('product_categories.name as category, sum(insureds.commission_amount) as count')
                ->groupBy('category')
                ->get();
        }
        return Insured::query()
            ->join('products', 'products.id', '=', 'insureds.product_id')
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->join('commissions', 'commissions.id', '=', 'insureds.commission_id')
            ->join('product_categories', 'product_categories.id', '=', 'commissions.product_category_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->where('commissions.user_id', '=', auth()->user()->id)
            ->where('product_categories.user_id', '=', auth()->user()->id)
            ->selectRaw('product_categories.name as category, sum(insureds.commission_amount) as count')
            ->groupBy('category')
            ->get();

    }

    public function commissionByInsuranceProvider(): \Illuminate\Database\Eloquent\Collection|array
    {
        if (auth()->user()->role == Role::ROLES[0]) {
            return Insured::query()
                ->join('commissions', 'commissions.id', '=', 'insureds.commission_id')
                ->join('suppliers', 'suppliers.id', '=', 'insureds.supplier_id')
                ->selectRaw('suppliers.name as provider, sum(insureds.commission_amount) as count')
                ->groupBy('provider')
                ->get();
        }
        return Insured::query()
            ->join('products', 'products.id', '=', 'insureds.product_id')
            ->join('clients', 'clients.id', '=', 'products.client_id')
            ->join('commissions', 'commissions.id', '=', 'insureds.commission_id')
            ->join('suppliers', 'suppliers.id', '=', 'insureds.supplier_id')
            ->where('clients.user_id', '=', auth()->user()->id)
            ->where('commissions.user_id', '=', auth()->user()->id)
            ->where('suppliers.user_id', '=', auth()->user()->id)
            ->selectRaw('suppliers.name as provider, sum(insureds.commission_amount) as count')
            ->groupBy('provider')
            ->get();

    }

    public function totalActivePolicies(): int
    {
        $policies = Insured::query()->where('status', '=', 1)->count();
        if (auth()->user()->role != Role::ROLES[0]) {
            $policies = Insured::query()
                ->join('products', 'products.id', '=', 'insureds.product_id')
                ->join('clients', 'clients.id', '=', 'products.client_id')
                ->where('clients.user_id', '=', auth()->user()->id)
                ->where('insureds.status', '=', 1)
                ->count('insureds.id');
        }
        return $policies;
    }


    public function roles()
    {
        return Doughnut::make(User::class)
            ->count('role');
    }

}
