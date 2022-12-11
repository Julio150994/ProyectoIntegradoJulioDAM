<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juegos')->insert(['nombre' => 'Trivial Pursuit Familia', 'descripcion' => 'Juego de preguntas', 'precio' => 34.56, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Monopoly Clásico', 'descripcion' => 'Juego basado en el intercambio y compraventa', 'precio' => 25.49, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Scrabble Original', 'descripcion' => 'Juego de palabras cruzadas para 2, 3 ó 4 jugadores', 'precio' => 18.25, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'IMagicBox Cife', 'descripcion' => 'Juego de cartomagia de póker', 'precio' => 8.19, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Catán Plus', 'descripcion' => 'Nueva edición de la versión Plus del popular juego, entre 2 y 6 jugadores', 'precio' => 62.99, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Virus', 'descripcion' => 'El juego de cartas ágil y rápido más contagioso', 'precio' => 14.95, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Uno', 'descripcion' => 'Juego de cartas clásico del Uno', 'precio' => 9.85, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Dixit Normal', 'descripcion' => ' Juego de cartas para adivinar la tarjeta del otro', 'precio' => 31.34, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Exploding Kittens', 'descripcion' => 'Juego de cartas donde debes sobrevivir ante gatos explosivos', 'precio' => 19.95, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Times Up Party', 'descripcion' => 'Edición party del Times Up', 'precio' => 19.90, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Risk Star Wars VII', 'descripcion' => 'El risk de la película Star Wars VII', 'precio' => 57.33, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Bang ¡La Bala!', 'descripcion' => 'Expansión del juego Bang original', 'precio' => 37.91, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Twister a ciegas', 'descripcion' => 'Como el Twister normal, pero con los ojos vendados', 'precio' => 20.59, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'El Valle de los Vikingos', 'descripcion' => 'Juego donde lanzamos toneles a otros jugadores', 'precio' => 24.86, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Preguntados', 'descripcion' => 'El juego de aplicación móvil, pero en tablero de mesa', 'precio' => 27.22, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Sándwich', 'descripcion' => 'Juego donde tienes que hacer el mejor sándwich', 'precio' => 14.95, 'stock' => '1']);
        DB::table('juegos')->insert(['nombre' => 'Mal trago', 'descripcion' => 'El juego de los goblins kamikazes', 'precio' => 13.73, 'stock' => '0']);
        DB::table('juegos')->insert(['nombre' => 'Ajedrez de Harry Potter', 'descripcion' => 'El ajedrez clásico de la película', 'precio' => 54.43, 'stock' => '0']);
        DB::table('juegos')->insert(['nombre' => 'Cluedo Ed. Sevilla', 'descripcion' => 'Sobre el asesinato de una cantautora', 'precio' => 30.20, 'stock' => '0']);
        DB::table('juegos')->insert(['nombre' => 'Black Stories', 'descripcion' => 'Juego de cartas para resolver diferentes situaciones oscuras', 'precio' => 15.95, 'stock' => '0']);
        DB::table('juegos')->insert(['nombre' => 'Prueba', 'descripcion' => 'Demo', 'precio' => 7.89, 'stock' => '0']);
    }
}
