<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DireccionesEnvio;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(DireccionesEnvio::class, function (Faker $faker) {
    return [
        'direccion' => $faker->sentence,
        'nombreCalle' => $faker->sentence,
        'portal' => $faker->randomDigit,
        'piso' => $faker->sentence,
        'codigoPostal' => $faker->randomDigit,
        'ciudad' => $faker->sentence,
        'provincia' => $faker->sentence,
        'pais' => $faker->sentence,
        'telefono' => $faker->sentence,
        'observaciones' => $faker->paragraph,
        'empresa_reparto_id' => factory(EmpresasReparto::class)->create(),
        'cliente_id' => factory(User::class)->create(),
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
