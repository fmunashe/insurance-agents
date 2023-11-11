<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InsuranceProvidersExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Supplier::all();
    }

    public function map($supplier): array
    {
        return [
            $supplier->name,
            $supplier->phone,
            $supplier->email,
            $supplier->address,
        ];
    }

    public function headings(): array
    {
        return [
            ['Name', 'Phone', 'Email', 'Address'],
        ];
    }
}