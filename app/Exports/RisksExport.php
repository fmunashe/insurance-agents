<?php

namespace App\Exports;

use App\Enum\Role;
use App\Models\Client;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RisksExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $products = Product::all();
        $clients = Client::query()
            ->where('user_id', '=', auth()->user()->id)
            ->pluck('id')->toArray();

        if (auth()->user()->role != Role::ROLES[0]) {
            $products = Product::query()
                ->whereIn('client_id', $clients)
                ->get();
        }
        return $products;
    }

    public function map($product): array
    {
        return [
            $product->client->agent->name??"",
            $product->category->name ?? "",
            $product->name ?? "",
            $product->description ?? "",
            $product->client->name ?? "" . $product->client->surname ?? "",
            $product->client->mobile ?? "",
            $product->client->email ?? ""
        ];
    }

    public function headings(): array
    {
        return [
            ['Agent','Risk Category', 'Risk Name', 'Risk Description','Client Full Name', 'Client Mobile', 'Client Email'],
        ];
    }
}
