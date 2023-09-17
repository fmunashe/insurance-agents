<?php

namespace App\Http\Controllers;

use App\Exports\ExportSalesReport;
use App\Http\Requests\SalesReportRequest;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generateSalesReport(SalesReportRequest $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $reportType = $request->input('reportType');
        if ($reportType == "excel") {
            return Excel::download(
                new ExportSalesReport($startDate, $endDate),
                $startDate . ' to ' . $endDate . ' SalesReport.xlsx',
                \Maatwebsite\Excel\Excel::XLSX
            );
        }
//        return Excel::download(new ExportSalesReport($startDate, $endDate), $startDate.' to '.$endDate.' SalesReport.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
