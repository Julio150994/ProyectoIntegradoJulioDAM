<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['nombre' => 'Admin', 'apellidos' => 'Admin', 'email' => 'admin@admin.com', 'username' => 'admin', 'password' => bcrypt('123456789'), 'role_id' => 1]);
        DB::table('users')->insert(['nombre' => 'Julio', 'apellidos' => 'Muñoz Chozas', 'email' => 'julio@gmail.com', 'username' => 'julio94', 'password' => bcrypt('secret'), 'role_id' => 3]);
        DB::table('users')->insert(['nombre' => 'Adrián', 'apellidos' => 'Reyes López', 'email' => 'adrian@gmail.com', 'username' => 'adri65', 'password' => bcrypt('secret'), 'role_id' => 2]);
        DB::table('users')->insert(['nombre' => 'Laura', 'apellidos' => 'Gómez Sánchez', 'email' => 'lausanchez@gmail.com', 'username' => 'lau96', 'password' => bcrypt('secret'), 'role_id' => 2]);
        DB::table('users')->insert(['nombre' => 'Guillermo', 'apellidos' => 'Álvarez Chozas', 'email' => 'guilleal@gmail.com', 'username' => 'guillalv43', 'password' => bcrypt('secret'), 'role_id' => 4]);
        DB::table('users')->insert(['nombre' => 'Francisco', 'apellidos' => 'Jimenez Lara', 'email' => 'franjila@gmail.com', 'username' => 'franji1992', 'password' => bcrypt('secret'), 'role_id' => 4]);
        DB::table('users')->insert(['nombre' => 'Paula', 'apellidos' => 'García Gutiérrez', 'email' => 'paulagarcia@gmail.com', 'username' => 'paula76', 'password' => bcrypt('secret'), 'role_id' => 3]);

        DB::table('users')->insert(['nombre' => 'Félix', 'apellidos' => 'Reyes Fernández', 'email' => 'felixreyes@gmail.com', 'username' => 'felixreyes', 'password' => bcrypt('secret'), 'role_id' => 4]);
    }
}
