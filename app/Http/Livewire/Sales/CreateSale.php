<?php

namespace App\Http\Livewire\Sales;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class CreateSale extends Component
{
    public $currencies;
    public $products;
    public $currencyId;
    public $productId;
    public $filteredCurrency;
    public $filteredProduct;

    public $total;
    public $product;
    public $price;
    public $availableStock;
    public $quantity;
    public $subTotal;

    public $fullname;
    public $phone;
    public $email;
    public $address;


    public $inputs = [];
    public $i = 0;

    public function mount()
    {
        $this->currencies = $this->getCurrenciesProperty();
        $this->products = $this->getProductsProperty();
        $this->total = 0;
    }

    public function updatedCurrencyId($value)
    {
        $this->filteredCurrency = $this->currencies->where('id', '=', $value)->first();
        $this->calculateTotal();
    }

    public function updatedProductId($value)
    {
        if (isset($value) && $value != null) {
            $this->filteredProduct = $this->products->where('id', '=', $value)->first();
            $this->price[$this->i] = $this->filteredProduct['price'];
            $this->availableStock[$this->i] = $this->filteredProduct['quantity'];
            $this->calculateTotal();
        } else {
            $this->resetInputFields();
        }

    }

    public function updatedQuantity($value)
    {
        if (isset($value) && $value != null) {
            $this->subTotal[$this->i] = $this->price[$this->i] * $value;
            $this->calculateTotal();
            Alert::toast("oops quantity cannot be more that available stock ", 'danger');
        }
    }

    public function render()
    {
        return view('livewire.sales.create-sale');
    }

    public function calculateTotal()
    {
        $this->total = 0;
        if (isset($this->subTotal)) {
            for ($i = 0; $i <= $this->i; $i++) {
                $this->total += $this->subTotal[$i] ?? 0;
            }
            $this->total *= $this->filteredCurrency['rate'] ?? 1;
        }
    }

    public function store()
    {
        $validatedData = $this->validate([
            'productId.0' => 'required',
            'price.0' => 'required',
            'quantity.0' => 'required',
            'subTotal.0' => 'required',
            'productId.*' => 'required',
            'price.*' => 'required',
            'quantity.*' => 'required',
            'subTotal.*' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ],
            [
                'productId.0.required' => 'Product field is required',
                'price.0.required' => 'Price field is required',
                'quantity.0.required' => 'Quantity field is required',
                'subTotal.0.required' => 'SubTotal field is required',
                'productId.*.required' => 'Product field is required',
                'price.*.required' => 'Price field is required',
                'quantity.*.required' => 'Quantity field is required',
                'subTotal.*.required' => 'SubTotal field is required',
            ]
        );

        $customer = $this->createCustomer();
        $sale = Sale::query()->create([
            'invoice_number' => $this->generateInvoiceNumber(),
            'user_id' => auth()->user()->id,
            'currency_id' => $this->filteredCurrency['id'],
            'rate' => $this->filteredCurrency['rate'],
            'customer_id' => $customer->id
        ]);

        $total = 0;
        foreach ($this->productId as $key => $value) {
            $quantity = ($this->quantity[$key] < $this->availableStock[$key]) ? $this->quantity[$key] : $this->availableStock[$key];

            $subTotal = $this->price[$key] * $quantity;
            $sale->saleItems()->create([
                'product_id' => $this->productId[$key],
                'quantity' => $quantity,
                'price' => $this->price[$key],
                'sub_total' => $subTotal
            ]);
            $total += $subTotal;
            $this->deductStock($this->productId[$key], $quantity);
        }

        $total *= $this->filteredCurrency['rate'];
        $sale->update(['total' => $total]);
        $this->inputs = [];

        $this->resetInputFields();

        $pdf = PDF::loadView('sales.receipt', compact('sale'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'receipt.pdf');
    }


    public function getCurrenciesProperty()
    {
        return Currency::all()->collect();
    }

    public function getProductsProperty()
    {
        return Product::query()
            ->where('quantity', '>', 0)
            ->get()
            ->collect();
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
        $this->calculateTotal();
    }

    private function resetInputFields()
    {
        $this->reset('product',
            'price', 'currencyId',
            'productId', 'subTotal',
            'quantity', 'filteredCurrency',
            'filteredProduct', 'total', 'i',
            'availableStock', 'fullname', 'phone', 'email', 'address');
    }

    private function deductStock($productId, $quantity)
    {
        $product = Product::query()->where('id', '=', $productId)->first();
        if ($product) {
            $product->update(['quantity' => ($product->quantity - $quantity)]);
        }
    }

    private function createCustomer()
    {
        return Customer::query()->create([
            'fullname' => $this->fullname,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);
    }

    private function generateInvoiceNumber(): string
    {
        $latestSale = Sale::query()->latest()->first();
        if ($latestSale == null) {
            return "INV" . str_pad(1, 7, "0", STR_PAD_LEFT);
        }
        return "INV" . str_pad($latestSale->id + 1, 7, "0", STR_PAD_LEFT);
    }
}
