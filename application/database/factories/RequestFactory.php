<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Request;
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

$factory->define(Request::class, function (Faker $faker) {
    return [
        'table_name' => $faker->randomAscii(1),
        'no' => $faker->text(20),
        'effective_date' => $faker->date()
    ];
});
