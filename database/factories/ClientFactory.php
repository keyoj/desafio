<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

$factory->define(Client::class, function (Faker $faker) {
    $date = Carbon::create(2020, 04, 03, 0, 0, 0);
    return [
        'name'=>$faker->name,
        'email'=>$faker->unique()->safeEmail,
        'join_date'=>$date->subWeeks(rand(0, 52))->format('Y-m-d'),
        // 'name'=>$faker->name,
    ];
});
