<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Mostramos los clientes en forma descendente
        $clientes = User::orderBy('id','DESC')->where('role_id', 4)->paginate(5);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Para mostrar el formulario de los clientes
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Request $request

    public function store(Request $request) {
        // Para la validación del nuevo cliente
        $this->validate($request, [
                'nombre' => 'required|max:40',
                'apellidos' => 'required|max:60',
                'email' => 'required|max:120',
                'username' => 'required|max:50|unique:users',
                'password' => 'required|min:1|max:70',
            ],
            ['nombre.required' => __("Debe introducir un nombre de cliente")],
            ['apellidos.required' => __("Debe introducir unos apellidos de cliente")],
            ['email.required' => __("Debe introducir un email de cliente")],
            ['username.required' => __("Debe introducir un nombre de usuario para el cliente")],
            ['username.unique' => __("Este nombre de usuario para el cliente ya existe")],
            ['password.required' => __("Debe introducir una contraseña para el cliente")]
        );

        // Añadimos un nuevo cliente (con asignación automática de rol)
        $data['nombre'] = $request->input('nombre');
        $data['apellidos'] = $request->input('apellidos');
        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
        $data['password'] = bcrypt($request->input('password'));// encriptamos la contraseña correctamente
        $data['role_id'] = 4;

        DB::table('users')->insert($data);
        $username = $data['username'];

        return redirect()->route('clientes.index')
            ->with('mensaje_cliente', ['success', __("Cliente $username añadido correctamente")]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $cliente = User::find($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // Para la validación del cliente seleccionado
        
        $this->validate($request, [
                'nombre' => 'required|max:40',
                'apellidos' => 'required|max:60',
                'email' => 'required|max:120',
                'username' => 'required|max:50',
                'password' => 'required|min:1|max:70',
            ],
            ['nombre.required' => __("Debe introducir el nombre de cliente")],
            ['apellidos.required' => __("Debe introducir los apellidos de cliente")],
            ['email.required' => __("Debe introducir el email de cliente")],
            ['username.required' => __("Debe introducir el nombre de usuario para el cliente")],
            ['username.unique' => __("Este nombre de usuario para el cliente ya existe")],
            ['password.required' => __("Debe introducir la contraseña para el cliente")],
            ['password.max' => __("La contraseña debe tener un máximo de 70 caracteres")]
        );

        // Editamos un nuevo cliente (con asignación automática de rol)
        $data['nombre'] = $request->input('nombre');
        $data['apellidos'] = $request->input('apellidos');
        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
        // Encriptamos la contraseña del cliente para iniciar sesión correctamente
        $password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $data['password'] = $password;
        $data['role_id'] = 4;// aquí asignamos el rol para el cliente

        DB::table('users')->where('id', $id)->update([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
            'role_id' => $data['role_id']
        ]);
        
        $username = $data['username'];

        return redirect()->route('clientes.index')
            ->with('mensaje_cliente', ['primary', __("Cliente $username editado correctamente")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // Eliminamos al cliente aplicando Soft Delete
        
        //$usuario = DB::table('users')->where('id', $id)->select('username')->get();
        //$cliente = $usuario->all();// recogemos el dato del username $username

        User::find($id)->delete();
        return back()->with('mensaje_cliente', ['danger', __("Cliente eliminado correctamente")]);
    }
}
