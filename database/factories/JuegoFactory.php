<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Juego;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Juego::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'descripcion' => $faker->sentence,
        'precio' => $faker->randomFloat,
        'stock' => $faker->randomDigit,
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
