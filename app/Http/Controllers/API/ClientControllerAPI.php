<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientControllerAPI extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $clients = Client::all();
        return ClientResource::collection($clients);
    }

    public function searchClient(Request $request): ClientResource
    {
        $client = Client::query()
            ->where('mobile', '=', $request->search)
            ->orWhere('email', '=', $request->search)
            ->first();
        return ClientResource::make($client);
    }

}
