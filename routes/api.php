<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('clients', "ClientController");
Route::get('payments', "PaymentsController@paymentsByClient");
Route::post('payments', "PaymentsController@storeClientPayment");
Route::get('dolar/{fecha?}', "PaymentsController@dolar");
