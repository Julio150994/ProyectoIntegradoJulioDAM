<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['nombre' => 'Administrador',]);//1
        DB::table('roles')->insert(['nombre' => 'Contable',]);//2
        DB::table('roles')->insert(['nombre' => 'Mozo',]);//3
        DB::table('roles')->insert(['nombre' => 'Cliente',]);//4
    }
}
