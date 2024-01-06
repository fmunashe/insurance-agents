<?php

namespace App\Exports;

use App\Enum\Role;
use App\Models\Insured;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PolicyExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $policies = Insured::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $policies = Insured::query()
                ->join('products', 'products.id', '=', 'insureds.product_id')
                ->join('clients', 'clients.id', '=', 'products.client_id')
                ->where('clients.user_id', '=', auth()->user()->id)
                ->selectRaw('insureds.*')
                ->get();
        }
        return $policies;
    }

    public function map($policy): array
    {
        return [
            $policy->product->name ?? "",
            $policy->product->category->name ?? "",
            $policy->product->client->name ?? "" . $policy->product->client->surname ?? "",
            $policy->product->client->mobile ?? "",
            $policy->product->client->email ?? "",
            $policy->provider->name ?? "",
            $policy->policy_number,
            $policy->sum_insured,
            $policy->premium,
            $policy->number_of_terms,
            Carbon::parse($policy->start_date)->format('d-m-Y'),
            Carbon::parse($policy->end_date)->format('d-m-Y'),
            $policy->status ? "Active" : "In-Active",
            $policy->currency->name ?? "",
            $policy->commission->riskCategory->name ?? "",
            $policy->commission->commission_percentage ?? "",
            $policy->commission_amount
        ];
    }

    public function headings(): array
    {
        return [
            ['Risk Name', 'Risk Category', 'Client Full Name', 'Client Mobile', 'Client Email', 'Insurance Provider',
                'Policy Number', 'Sum Insured', 'Premium', 'Number Of Terms', 'Start Date', 'End Date', 'Status', 'Currency',
                'Commission Band', 'Commission Percentage', 'Commission Amount'],
        ];
    }
}
