<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenesJuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/trivial_pursuit_familia.png', 'juego_id' => 1]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/pursuit_family.png', 'juego_id' => 1]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/monopoly_clasico_caja_roja.png', 'juego_id' => 2]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/monopoly_clasico_tablero.png', 'juego_id' => 2]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/scrabble_original.png', 'juego_id' => 3]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/scrabble_original_castellano.png', 'juego_id' => 3]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/imagicbox_caja_cartomagia.png', 'juego_id' => 4]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/imagicbox_juego_magia_poker.png', 'juego_id' => 4]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/catan_version_plus.png', 'juego_id' => 5]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/catan_plus_posterior.png', 'juego_id' => 5]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/virus_juego.png', 'juego_id' => 6]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/virus_cartas_basicas.png', 'juego_id' => 6]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/uno_juego_logo.png', 'juego_id' => 7]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/uno_juego_cartas.png', 'juego_id' => 7]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/dixit_normal.png', 'juego_id' => 8]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/dixit_tablero.png', 'juego_id' => 8]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/exploding_kittens_caja.png', 'juego_id' => 9]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/exploding_kittens_cartas.png', 'juego_id' => 9]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/times_up_party.png', 'juego_id' => 10]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/times_up_party_elementos_juego.png', 'juego_id' => 10]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/risk_star_wars_vii.png', 'juego_id' => 11]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/risk_star_wars_vii_tablero.png', 'juego_id' => 11]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/bang_bala_juego.png', 'juego_id' => 12]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/bang_bala_cartas.png', 'juego_id' => 12]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/twister_a_ciegas_caja.png', 'juego_id' => 13]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/twister_a_ciegas_tablero.png', 'juego_id' => 13]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/valle_de_los_vikingos_caja.png', 'juego_id' => 14]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/valle_de_los_vikingos_tablero.png', 'juego_id' => 14]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/preguntados_juego.png', 'juego_id' => 15]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/preguntados_juego_tablero.png', 'juego_id' => 15]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/sandwich_juego.png', 'juego_id' => 16]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/sandwich_juego_cartas.png', 'juego_id' => 16]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/mal_trago_juego_caja.png', 'juego_id' => 17]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/mal_trago_juego_cartas.png', 'juego_id' => 17]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/ajedrez_harry_potter_caja.png', 'juego_id' => 18]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/ajedrez_harry_potter_tablero.png', 'juego_id' => 18]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/cluedo_edicion_sevilla.png', 'juego_id' => 19]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/cluedo_edicion_sevilla_tablero.png', 'juego_id' => 19]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/black_stories_juego_caja.png', 'juego_id' => 20]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/black_stories_juego_cartas.png', 'juego_id' => 20]);
        DB::table('imagenes_juegos')->insert(['url' => 'images/juegos_mesa/log_prueba.png', 'juego_id' => 21]);
    }
}
