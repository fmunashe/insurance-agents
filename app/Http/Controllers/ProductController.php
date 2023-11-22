<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Client;
use App\Models\Commission;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::query()
            ->where('user_id', '=', auth()->user()->id)
            ->pluck('id')->toArray();

        $products = Product::query()
            ->whereIn('client_id', $clients)
            ->get();

        if (auth()->user()->role == Role::ROLES[0]) {
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();

        $clients = Client::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $clients = Client::query()->where('user_id', '=', auth()->user()->id)->get();
            $categories = $categories->where('user_id','=',auth()->user()->id)->collect();
        }
        return view('products.create', compact('categories', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::query()->create($request->all());
//        $product->insureds()->create($request->all());
        Alert::toast('New Product Successfully Created', 'success');
        return to_route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if ($product->client->user_id != auth()->user()->id && auth()->user()->role != Role::ROLES[0]) {
            abort(403, 'Action not allowed');
        }
        $bands = Commission::query()->where('user_id', '=', auth()->user()->id)->get();

        $currencies = Currency::all();
        $providers = Supplier::all();
        $categories = ProductCategory::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $categories = $categories->where('user_id','=',auth()->user()->id)->collect();
        }
        return view('products.show', compact('product', 'currencies', 'providers', 'categories', 'bands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if ($product->client->user_id != auth()->user()->id && auth()->user()->role != Role::ROLES[0]) {
            abort(403, 'Action not allowed');
        }
        $categories = ProductCategory::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $categories = $categories->where('user_id','=',auth()->user()->id)->collect();
        }
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        Alert::toast('Product Successfully Updated', 'success');
        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->client->user_id != auth()->user()->id && auth()->user()->role != Role::ROLES[0]) {
            abort(403, 'Action not allowed');
        }
        $product->delete();
        Alert::toast('Product Successfully Removed', 'success');
        return to_route('products.index');
    }
}
