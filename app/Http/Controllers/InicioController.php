<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller {
    /* Métodos para la plantilla inicial de la aplicación de Laravel de Landgame (navbar de arriba y menú lateral) */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        return view('inicio');
    }
}
