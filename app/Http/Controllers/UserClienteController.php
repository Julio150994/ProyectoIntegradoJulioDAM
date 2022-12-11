<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserClienteController extends Controller {
    // Para mostrar el menú principal de los clientes al iniciar sesión
    public function menu() {
        return view('cliente.menu');
    }
}
