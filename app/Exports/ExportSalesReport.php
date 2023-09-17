<?php

namespace App\Exports;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSalesReport implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::make($startDate)->startOfDay();
        $this->endDate = Carbon::make($endDate)->endOfDay();
    }


    public function collection()
    {
        return Sale::query()->whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function map($sale): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        return [
            Carbon::make($sale->created_at)->format('m/d/Y'),
            $sale->invoice_number,
            "Sales",
            $sale->customer->fullname ?? "",
            $sale->saleItems()->sum('quantity'),
            $sale->saleItems()->sum('sub_total'),
            'Cash'
        ];
    }

    public function headings(): array
    {
        return [
            [Carbon::now()->format('d-M-Y'), '', '', 'Exide Express Rusape', '', '', ''],
            [Carbon::now()->format('g:i A'), '', '', 'Sale Detail', '', '', ''],
            ['Date', 'Receipt #', 'Receipt Type', 'Full Name', 'Qty Sold', 'Total Amount', 'Payment'],
        ];
    }

    public function view(): View
    {
        $sales = Sale::query()->whereBetween('created_at', [$this->startDate, $this->endDate])->get();
        $quantity = 0;
        $total = 0;
        foreach($sales as $sale){
            $quantity += $sale->saleItems()->sum('quantity');
            $total += $sale->saleItems()->sum('sub_total');
        }

        return  view('reports.salesReport',compact('sales','total','quantity'));
    }
}
