<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Role;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->nombre,
        'apellidos' => $faker->apellidos,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'username' => $faker->username,
        'password' => $faker->password,
        'role_id' => factory(Role::class)->create(),
        'is_logged' => false,
        'deleted' => 0,
        'remember_token' => Str::random(10),
    ];
});
