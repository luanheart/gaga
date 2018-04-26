<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(App\Models\User::class, function (Faker $faker) {

    $now = Carbon::now()->toDateTimeString();

    return [
        'openid' => str_random(10),
        'unionid' => str_random(10),
        'nickname' => $faker->name,
        'birthday' => $faker->date(),
        'sex' => $faker->randomElement([0, 1, 2]),
        'height' => $faker->numberBetween(160, 190),
        'weight' => $faker->numberBetween(50, 100),
        'attribute' => $faker->numberBetween(0, 7),
        'wechat' => str_random(8),
        'job' => $faker->jobTitle,
        'created_at' => $now,
        'updated_at' => $now
    ];
});
