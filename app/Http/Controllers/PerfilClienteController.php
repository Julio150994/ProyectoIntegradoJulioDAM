<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        $id = auth()->user()->id;// obtenemos el id de usuario actual
        $nombre = auth()->user()->nombre;
        $apellidos = auth()->user()->apellidos;
        $email = auth()->user()->email;
        $username = auth()->user()->username;

        return view('cliente.perfil', compact('id', 'nombre', 'apellidos', 'email', 'username'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // Para editar el propio cliente con el que nos hemos logueado
        $this->validate($request, [
                'nombre' => 'required|max:40',
                'apellidos' => 'required|max:60',
                'email' => 'required|max:120',
                'username' => 'required|max:50',
                'password' => 'required|min:1|max:70',
            ],
            ['nombre.required' => __("Debe introducir su nombre")],
            ['apellidos.required' => __("Debe introducir sus apellidos")],
            ['email.required' => __("Debe introducir su email")],
            ['username.required' => __("Debe introducir su nombre de usuario")],
            ['username.unique' => __("Este nombre de usuario ya existe")],
            ['password.required' => __("Debe introducir su contraseña")],
            ['password.max' => __("Su contraseña debe tener un máximo de 70 caracteres")],
        );

        // Editamos el perfil de nuestro cliente actual (con asignación automática de rol)
        $data['nombre'] = $request->input('nombre');
        $data['apellidos'] = $request->input('apellidos');
        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
        // Encriptamos su contraseña para iniciar sesión correctamente
        $password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $data['password'] = $password;
        $data['role_id'] = 4;// para autoasignar el rol de cliente

        DB::table('users')->where('id', $id)->update([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
            'role_id' => $data['role_id']
        ]);

        return redirect()->route('menu_tienda')
            ->with('mensaje_perfil', ['primary', __("Su perfil ha sido editado correctamente")]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
