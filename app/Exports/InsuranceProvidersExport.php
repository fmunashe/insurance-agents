<?php

namespace App\Exports;

use App\Enum\Role;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InsuranceProvidersExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $suppliers = Supplier::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $suppliers = $suppliers->where('user_id', '=', auth()->user()->id);
        }
        return $suppliers;
    }

    public function map($supplier): array
    {
        return [
            $supplier->agent->name ?? "",
            $supplier->name,
            $supplier->phone,
            $supplier->email,
            $supplier->address,
        ];
    }

    public function headings(): array
    {
        return [
            ['Agent', 'Name', 'Phone', 'Email', 'Address'],
        ];
    }
}
