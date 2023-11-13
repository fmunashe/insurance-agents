<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $clients = Client::query()->where('user_id', '=', auth()->user()->id)->get();
        }

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        Client::query()->create($request->all());
        Alert::toast('Client Successfully Created', 'success');
        return to_route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        if (auth()->user()->role != Role::ROLES[0] && $client->user_id != auth()->user()->id) {
            abort('403', 'Action not authorised');
        }
        $currencies = Currency::all();
        $providers = Supplier::all();
        $categories = ProductCategory::all();
        $products = Product::query()->where('client_id', $client->id)->get();
        return view('clients.show', compact('client', 'currencies', 'providers', 'categories', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        if (auth()->user()->role != Role::ROLES[0] && $client->user_id != auth()->user()->id) {
            abort('403', 'Action not authorised');
        }
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());
        Alert::toast('Client Successfully Updated', 'success');
        return to_route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        if (auth()->user()->role != Role::ROLES[0] && $client->user_id != auth()->user()->id) {
            abort('403', 'Action not authorised');
        }
        $client->delete();
        Alert::toast('Client Successfully removed', 'success');
        return to_route('clients.index');
    }
}
