<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmpresasReparto;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(EmpresasReparto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'direccion' => $faker->sentence,
        'email' => $faker->randomDigit,
        'email_verified_at' => now(),
        'telefono' => $faker->sentence,
        'imagen' => $faker->sentence,
        'coste_pedido_urgente' => $faker->randomFloat,
        'coste_pedido_normal' => $faker->randomFloat,
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
