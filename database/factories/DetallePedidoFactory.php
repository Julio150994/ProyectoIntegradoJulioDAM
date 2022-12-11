<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DetallePedido;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(DetallePedido::class, function (Faker $faker) {
    return [
        'cantidad' => $faker->randomDigit,
        'precioUnitario' => $faker->randomFloat,
        'pedido_id' => factory(Pedido::class)->create(),
        'juego_id' => factory(Juego::class)->create(),
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
