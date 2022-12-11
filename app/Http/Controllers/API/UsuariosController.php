<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
//use Illuminate\Http\Request;


class UsuariosController extends Controller
{
    public $apiStatus = [200, 401, 404, 403];

    /** -------  Para obtener todos los usuarios de la tienda  (username) -------- */
    public function obtenerUsuarios() {
        $listadoUsuarios = User::orderBy('id', 'ASC')->get();

        $usuarios = array();
        $datosUsuario = "";

        foreach ($listadoUsuarios as $usuario) {
            $datosUsuario = $usuario;
            array_push($usuarios, $datosUsuario);// listamos a todos los usuarios
        }

        if (in_array($datosUsuario, $usuarios)) {
            return response()->json(['success' => $usuarios], $this->apiStatus[0]);
        }
        else {
            return response()->json(['error' => 'Usuarios no encontrados en la base de datos'], $this->apiStatus[2]);
        }
    }
}
