<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class CreateOrder extends Component
{
    public $suppliers;
    public $products;
    public $product;
    public $productId;
    public $supplierId;
    public $quantity;
    public $inputs = [];
    public $i = 0;

    public function mount()
    {
        $this->products = $this->getProductsProperty();
        $this->suppliers = $this->getSuppliersProperty();
        $this->total = 0;
    }

    public function render()
    {
        return view('livewire.orders.create-order');
    }

    public function getProductsProperty()
    {
        return Product::all()->collect();
    }

    public function getSuppliersProperty()
    {
        return Supplier::all()->collect();
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields()
    {
        $this->reset(
            'product',
            'productId',
            'supplierId',
            'quantity',
            'i'
        );
    }

    private function generateOrderNumber(): string
    {
        $latestOrder = Order::query()->latest()->first();
        if ($latestOrder == null) {
            return "Ord#-" . str_pad(1, 7, "0", STR_PAD_LEFT);
        }
        return "Ord#-" . str_pad($latestOrder->id + 1, 7, "0", STR_PAD_LEFT);
    }


    public function store()
    {
        $validatedData = $this->validate([
            'productId.0' => 'required',
            'supplierId' => 'required',
            'quantity.0' => 'required',
            'productId.*' => 'required',
            'quantity.*' => 'required',
        ],
            [
                'productId.0.required' => 'Product field is required',
                'quantity.0.required' => 'Quantity field is required',
                'productId.*.required' => 'Product field is required',
                'quantity.*.required' => 'Quantity field is required',
            ]
        );

        $order = Order::query()->create([
            'order_number' => $this->generateOrderNumber(),
            'supplier_id' => $this->supplierId
        ]);


        $total = 0;
        foreach ($this->productId as $key => $value) {
            $order->orderItems()->create([
                'product_id' => $this->productId[$key],
                'ordered' => $this->quantity[$key],
                'received' => 0,
                'outstanding' => $this->quantity[$key],
            ]);
            $total += $this->quantity[$key];
        }

        $order->update(['ordered_quantity' => $total]);
        $this->inputs = [];

        $this->resetInputFields();

        $pdf = PDF::loadView('orders.receipt', compact('order'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'OrderNote.pdf');
    }
}
