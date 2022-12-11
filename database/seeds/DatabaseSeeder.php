<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Seeders para nuestros roles de usuario
        $this->call(RoleSeeder::class);

        // Seeders para nuestros usuarios de la aplicación web
        $this->call(UserSeeder::class);

        // Seeders para nuestros juegos de mesa
        $this->call(JuegoSeeder::class);

        // Seeders para la tabla de las imágenes de nuestros juegos de mesa
        $this->call(ImagenesJuegoSeeder::class);

        // Seeders para nuestras empresas de envio
        $this->call(EmpresaRepartoSeeder::class);
    }
}
