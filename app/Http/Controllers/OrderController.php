<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('orders.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        Order::query()->create($request->all());
        Alert::toast("Order Created Successfully", 'success');
        return to_route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());
        Alert::toast("Order Updated Successfully", 'success');
        return to_route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        Alert::toast("Order Removed Successfully", 'success');
        return to_route('orders.index');
    }

    public function download(Order $order)
    {
        $pdf = PDF::loadView('orders.receipt', compact('order'));
//        $pdf->setPaper('A4','landscape');
        return $pdf->stream("OrderNote.pdf");

    }
}
