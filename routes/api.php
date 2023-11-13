<?php

use App\Http\Controllers\API\ClientControllerAPI;
use App\Http\Controllers\API\CurrencyControllerAPI;
use App\Http\Controllers\API\V1\CallSummaryAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('currency', [CurrencyControllerAPI::class, 'index']);
Route::get('getClients', [ClientControllerAPI::class, 'index']);
