<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
