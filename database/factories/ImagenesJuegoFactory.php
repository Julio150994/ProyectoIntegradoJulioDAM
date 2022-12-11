<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImagenesJuego;
use App\Juego;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ImagenesJuego::class, function (Faker $faker) {
    return [
        'url' => $faker->sentence,
        'juego_id' => factory(Juego::class)->create(),
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
