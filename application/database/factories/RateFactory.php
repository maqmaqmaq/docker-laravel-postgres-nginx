<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rate;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'currency' => $faker->randomAscii(20),
        'code' => $faker->randomLetter(3),
        'mid' => $faker->randomFloat(8,0,99),
        'request_id' => $faker->randomDigitNot(0)
    ];
});
