<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockReceivingRequest;
use App\Http\Requests\UpdateStockReceivingRequest;
use App\Models\StockReceiving;
use RealRashid\SweetAlert\Facades\Alert;

class StockReceivingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receivedStock = StockReceiving::all();
        return view('stockReceiving.index', compact('receivedStock'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stockReceiving.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockReceivingRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(StockReceiving $stockReceiving)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockReceiving $stockReceiving)
    {
        return view('stockReceiving.edit', compact('stockReceiving'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockReceivingRequest $request, StockReceiving $stockReceiving)
    {
        $stockReceiving->update($request->all());
        Alert::toast("Product Updated Successfully", 'success');
        return to_route('stockReceiving.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockReceiving $stockReceiving)
    {
        $stockReceiving->delete();
        Alert::toast("Product Removed Successfully", 'success');
        return to_route('stockReceiving.index');
    }
}
