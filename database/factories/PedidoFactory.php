<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pedido;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Pedido::class, function (Faker $faker) {
    return [
        'precioTotal' => $faker->randomFloat,
        'fechaCompra' => date($format = 'Y-m-d', $max = 'now'),
        'cliente_id' => factory(User::class)->create(),
        'estado' => $faker->sentence,
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
