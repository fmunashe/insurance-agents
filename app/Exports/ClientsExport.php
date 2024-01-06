<?php

namespace App\Exports;

use App\Enum\Role;
use App\Models\Client;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $clients = Client::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $clients = $clients->where('user_id', '=', auth()->user()->id);
        }
        return $clients;
    }

    public function map($client): array
    {
        return [
            $client->agent->name ?? "",
            $client->name,
            $client->surname,
            $client->gender,
            $client->id_number,
            $client->mobile,
            $client->email,
            $client->address,
            $client->created_at ? Carbon::parse($client->created_at)->format('d-m-Y') : Carbon::now()
        ];
    }

    public function headings(): array
    {
        return [
            ['Agent', 'Name', 'Surname', 'Gender', 'ID Number', 'Mobile', 'Email', 'Address', 'Registered Date'],
        ];
    }
}
