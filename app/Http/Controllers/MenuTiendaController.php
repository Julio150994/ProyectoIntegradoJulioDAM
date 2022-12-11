<?php

namespace App\Http\Controllers;

use App\ImagenesJuego;
use App\Juego;

class MenuTiendaController extends Controller
{
    /**
     * Métodos para la plantilla inicial de la aplicacion de Laravel
     * (menú principal de la tienda)
     */

     public function __construct()
     {
        // Aplicamos el middleware solamente en el menú del cliente
        $this->middleware('cliente', ['only' => ['menuCliente']]);
     }

    /**
     * Display a show main menu of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu() {
        $numJuegos = Juego::count();// recibimos el número total de juegos

        $juegos = Juego::orderBy('id', 'ASC')->get();

        /** Mostramos los primeros 12 juegos existentes */
        $primerosJuegos = Juego::limit(12)->get();

        /** Mostramos más juegos hasta un número determinado que queramos */
        $masJuegos = Juego::orderBy('id', 'ASC')
            ->offset($numJuegos - 9)
            ->limit(9)
            ->get();

        // Consulta para obtener las primeras imágenes de cada grupo de juegos de mesa
        $imagenes = ImagenesJuego::groupBy('juego_id')->orderBy('id', 'ASC')->get();

        return view('menu_tienda', compact('juegos', 'imagenes', 'primerosJuegos', 'masJuegos'));
    }


    /**
     * Display a show main menu of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menuCliente() {
        $numJuegos = Juego::count();// recibimos el número total de juegos

        $juegos = Juego::orderBy('id', 'ASC')->get();

        /** Mostramos los primeros 12 juegos existentes */
        $primerosJuegos = Juego::limit(12)->get();

        /** Mostramos más juegos hasta un número determinado que queramos */
        $masJuegos = Juego::orderBy('id', 'ASC')
            ->offset($numJuegos - 9)
            ->limit(9)
            ->get();

        // Consulta para obtener las primeras imágenes de cada grupo de juegos de mesa
        $imagenes = ImagenesJuego::groupBy('juego_id')->orderBy('id', 'ASC')->get();

        return view('menu_tienda', compact('juegos', 'imagenes', 'primerosJuegos', 'masJuegos'));
    }


    /**
     * Display para visualizar el juego a añadir al carrito.
     *
     * @return \Illuminate\Http\Response
     */

    public function verJuego($id) {
        $cantidad = 1;// inicializamos la cantidad
        $precioUnitario = 0.0;

        $juegoMesa = Juego::find($id);

        $imagenes = ImagenesJuego::groupBy('juego_id')->orderBy('id','ASC')->get();

        return view('cliente.carrito', compact('juegoMesa', 'imagenes', 'cantidad', 'precioUnitario'));
    }
}
