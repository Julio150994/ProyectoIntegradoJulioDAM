<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ApiAuthController extends Controller {
    public $apiStatus = [200, 401, 404, 403];


    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'registerClient']]);
    }

    /** ---------  Registro de clientes  --------------- */

    public function register(Request $data) {
        $usuarioCliente = $data->all();

        $validarDatos = Validator::make($usuarioCliente, [
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required'
        ]);

        /* Validamos que se hayan introducido los datos del cliente */
        if($validarDatos->fails()) {
            return response()->json(['error' => 'Error al registrar este cliente'], $this->apiStatus[1]);
        }

        $usuarioCliente = $data->all();
        $usuarioCliente['password'] = bcrypt($usuarioCliente['password']);
        $cliente = User::create($usuarioCliente);

         // Mostramos los parámetros que se han registrado del nuevo cliente
         $success['nombre'] = $cliente->nombre;
         $success['apellidos'] = $cliente->apellidos;
         $success['email'] = $cliente->email;
         $success['username'] = $cliente->username;
         $success['password'] = $cliente->password;
         $success['role_id'] = $cliente->role_id;

         return response()->json(['success' => $success,
             'message' => 'Cliente '+$success['username']+' registrado correctamente'], $this->apiStatus[0]);
    }


    /** -------- Iniciamos sesión con los usuarios clientes -------- */
    public function login(Request $request) {
        $datas = $request->all();

        $username = $request->input('username');

        $validarDatos = Validator::make($datas, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validarDatos->fails()) {
            return response()->json(['error' => 'Faltan credenciales de usuario por introducir'], $this->apiStatus[1]);
        }
        else {
            /* Validamos que el usuario se encuentre en la base de datos de la aplicación */
            $listaUsuarios = User::all();
            $usuariosListados = array();

            foreach ($listaUsuarios as $usuario) {
                array_push($usuariosListados, $usuario->username);// listamos a todos los usuarios
            }

            if (in_array($username, $usuariosListados)) {
                /** Validamos que las credenciales de usuario estén correctas */
                if(Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
                    $usuario = Auth::user();

                    // Evitamos el inicio de sesión de un solo usuario múltiples veces
                    $data['is_logged'] = 1;

                    DB::table('users')->where('id', auth()->id())->update([
                        'is_logged' => $data['is_logged']
                    ]);

                    /* Mostramos los datos del cliente de manera ordenada */
                    $tokenLandgame['id'] = $usuario->id;
                    $tokenLandgame['nombre'] = $usuario->nombre;
                    $tokenLandgame['apellidos'] = $usuario->apellidos;
                    $tokenLandgame['email'] = $usuario->email;
                    $tokenLandgame['username'] = $usuario->username;
                    $tokenLandgame['password'] = $usuario->password;
                    $tokenLandgame['role_id'] = $usuario->role_id;
                    $tokenLandgame['is_logged'] = $usuario->is_logged;

                    // Establecemos el inicio de sesión

                    $nombreUsuario = $tokenLandgame['username'];

                    /* Validamos que el usuario administrador y los clientes sean quienes inicien sesión */

                    if ($usuario->role_id == 1) {
                        // Creamos token para el administrador, para cuando no hemos creado ninguno

                        $tokenLandgame['token'] = $usuario->createToken('Landgame')->accessToken;

                        return response()->json(['success' => $tokenLandgame,
                            'message' => 'El administrador ha iniciado sesión éxitosamente.']
                            , $this->apiStatus[0]);
                    }
                    elseif ($usuario->role_id == 2) {
                        return response()->json(['warning' => 'No puede iniciar sesión con el usuario contable']
                            , $this->apiStatus[3]);
                    }
                    elseif ($usuario->role_id == 3) {
                        return response()->json(['warning' => 'No puede iniciar sesión con el usuario mozo']
                            , $this->apiStatus[3]);
                    }
                    elseif($usuario->role_id == 4) {
                        // Creamos token para los clientes, para cuando no hemos creado ninguno

                        $tokenLandgame['token'] = $usuario->createToken('Landgame')->accessToken;

                        return response()->json(['success' => $tokenLandgame,
                            'message' => 'El cliente '.$nombreUsuario.' ha iniciado sesión éxitosamente.']
                            , $this->apiStatus[0]);
                    }
                }
                else {
                    return response()->json(['error' => 'Error al introducir la contraseña '.$username]
                    , $this->apiStatus[1]);
                }
            }
            else {
                return response()->json(['error' => 'Usuario '.$username.' no registrado en la tienda Landgame']
                    , $this->apiStatus[2]);
            }
        }
    }


    /** --------- Para cerrar sesión de los clientes ------------- */
    public function logout() {
        $usuario = User::find(auth()->id());
        $username = $usuario->username;

        // Evitamos cerrar sesión con un solo usuario múltiples veces
        $data['is_logged'] = 0;

        DB::table('users')->where('id', auth()->id())->update([
            'is_logged' => $data['is_logged']
        ]);

        return response()->json(['success' => $username.' ha cerrado sesión éxitosamente'], $this->apiStatus[0]);
    }
}
