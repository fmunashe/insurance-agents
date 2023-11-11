<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyControllerAPI extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return CurrencyResource::collection($currencies);
    }
}
