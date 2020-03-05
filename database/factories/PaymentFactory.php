<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\PaymentsController;

$factory->define(Payment::class, function (Faker $faker) {
    $date = Carbon::now();
    $status=Array(1,2);
    $datePayment= $date->subWeeks(rand(0, 8))->format('Y-m-d');
    $array=[null,$datePayment];
    $datePaymentRand=$array[array_rand($array)];
    $dolar=0;

    if($datePaymentRand!=null){
        $dolar=PaymentsController::dolar($datePayment)['value_dolar'];
    }
    return [
        'uuid'=>(string) Str::uuid(),
        'expires_at'=>$date->addWeeks(rand(1, 8))->format('Y-m-d'),
        'payment_date'=>$datePaymentRand,
        'status'=>$status[array_rand($status)],
        'amount'=>mt_rand(10000,500000),
        'clp_usd'=> $dolar,
    ];
});
