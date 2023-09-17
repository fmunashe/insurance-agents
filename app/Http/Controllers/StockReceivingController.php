<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockReceivingRequest;
use App\Http\Requests\UpdateStockReceivingRequest;
use App\Models\Order;
use App\Models\Product;
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
        $products = Product::all();
        return view('stockReceiving.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockReceivingRequest $request)
    {
        $data = $request->all();
        $order = Order::query()->where('order_number', '=', $data['order_number'])->first();
        if ($order->status != "pending") {
            Alert::toast("This order was already processed, Please check and try again or raise a new order", 'error');
            return to_route('orders.index');
        }
        $data['user_id'] = auth()->user()->id;
        $stock = StockReceiving::query()->create($data);
        $stock->product()->update([
            'quantity' => $stock->quantity + $stock->product->quantity
        ]);

        $order = Order::query()->where('order_number', '=', $data['order_number'])->first();
        $item = $order->orderItems()->where('product_id', $stock->product->id)->first();
        if ($item) {
            $item->update([
                'received' => $item->received + $data['quantity'],
                'outstanding' => abs(($item->outstanding - $data['quantity']))
            ]);
        }
        if ($order->orderItems()->sum('outstanding') == 0) {
            $order->update([
                'status' => 'processed'
            ]);
        }

        Alert::toast("Product Updated Successfully", 'success');
        return to_route('stockReceiving.index');
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
        $products = Product::all();
        return view('stockReceiving.edit', compact('stockReceiving', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockReceivingRequest $request, StockReceiving $stockReceiving)
    {
        $data = $request->all();
        $data['user_id'] = $stockReceiving->user_id;

        $quantity = $stockReceiving->product->quantity - $stockReceiving->quantity;
        $stockReceiving->product()->update([
            'quantity' => $quantity
        ]);

        $product = Product::query()->where('id', $stockReceiving->product_id)->first();
        $stockReceiving->update($data);
        $stockReceiving->product()->update([
            'quantity' => $data['quantity'] + $product->quantity
        ]);
        Alert::toast("Product Updated Successfully", 'success');
        return to_route('stockReceiving.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockReceiving $stockReceiving)
    {
        $stockReceiving->product()->update([
            'quantity' => $stockReceiving->product->quantity - $stockReceiving->quantity
        ]);
        $stockReceiving->delete();
        Alert::toast("Product Removed Successfully", 'success');
        return to_route('stockReceiving.index');
    }
}
