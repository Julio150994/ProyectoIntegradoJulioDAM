<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Consulta para asignar el rol con el empleado correspondiente
        $roles = DB::table('roles')
            ->join('users', 'roles.id', '=', 'users.role_id')
            ->where('users.role_id', 2)
            ->orWhere('users.role_id', 3)
            ->select('roles.*')
            ->get();

        // Consulta para visualizar todos los empleados en orden descendente
        $empleados = User::orderBy('id', 'DESC')->where('role_id', 2)->orWhere('role_id', 3)->paginate(5);

        foreach ($roles as $item => $role) {
            return view('empleados.index', compact('empleados', 'role'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::orderBy('id', 'ASC')->where('id',2)->orWhere('id',3)->get();
        return view('empleados.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // Para la validación del nuevo empleado
        $this->validate($request, [
                'nombre' => 'required|max:40',
                'apellidos' => 'required|max:60',
                'email' => 'required|max:120',
                'username' => 'required|max:50|unique:users',
                'password' => 'required|min:1|max:70',
            ],
            ['nombre.required' => __("Debe introducir un nombre de empleado")],
            ['apellidos.required' => __("Debe introducir un nombre de empleado")],
            ['email.required' => __("Debe introducir un email de empleado")],
            ['username.required' => __("Debe introducir un nombre de usuario para el empleado")],
            ['username.unique' => __("Este nombre de usuario para el empleado ya existe")],
            ['password.required' => __("Debe introducir una contraseña para el empleado")]
        );

        // Añadimos un nuevo cliente (con asignación automática de rol)
        $data['nombre'] = $request->input('nombre');
        $data['apellidos'] = $request->input('apellidos');
        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
        $data['password'] = bcrypt($request->input('password'));// encriptamos la contraseña correctamente
        $data['role_id'] = $request->input('role_id');// aquí asignamos el rol del contable

        DB::table('users')->insert($data);// aquí añadimos al empleado
        $username = $data['username'];

        if ($data['role_id'] == 2) {
            return redirect()->route('empleados.index')
                ->with('mensaje_empleado', ['success', __("Contable $username añadido correctamente")]);
        }
        else if ($data['role_id'] == 3) {
            return redirect()->route('empleados.index')
                ->with('mensaje_empleado', ['success', __("Mozo de almacén $username añadido correctamente")]);
        }
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
    public function edit($id) {
        $empleado = User::find($id);

        $usernameEmpleado = $empleado->username;

        // Obtenemos el rol de empleado actual
        $usuarios = DB::table('roles')
            ->join('users', 'users.role_id', '=', 'roles.id')
            ->select('roles.nombre')
            ->where('users.username', $usernameEmpleado)
            ->get();


        foreach ($usuarios as $auxEmpleado) {
            foreach ($auxEmpleado as $rolEmpleadoActual) {
                $roles = Role::orderBy('id', 'ASC')->where('id', 2)->orWhere('id', 3)->get();

                return view('empleados.edit', compact('empleado', 'roles', 'rolEmpleadoActual'));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // Para la validación del empleado seleccionado

        $this->validate($request, [
                'nombre' => 'required|max:40',
                'apellidos' => 'required|max:60',
                'email' => 'required|max:120',
                'username' => 'required|max:50',
                'password' => 'required|min:1|max:70',
            ],
            ['nombre.required' => __("Debe introducir un nombre de empleado")],
            ['apellidos.required' => __("Debe introducir un nombre de empleado")],
            ['email.required' => __("Debe introducir un email de empleado")],
            ['username.required' => __("Debe introducir un nombre de usuario para el empleado")],
            ['username.unique' => __("Este nombre de usuario para el empleado ya existe")],
            ['password.required' => __("Debe introducir una contraseña para el empleado")],
            ['password.max' => __("La contraseña debe tener un máximo de 70 caracteres")]
        );

        // Editamos el empleado seleccionado (con asignación automática de rol)
        $data['nombre'] = $request->input('nombre');
        $data['apellidos'] = $request->input('apellidos');
        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
        // Encriptamos la contraseña del empleado para iniciar sesión correctamente
        $password = password_hash($request->input('password'), PASSWORD_BCRYPT);
        $data['password'] = $password;
        $data['role_id'] = $request->input('role_id');// aquí asignamos el rol para el empleado

        DB::table('users')->where('id', $id)->update([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
            'role_id' => $data['role_id']
        ]);

        $username = $data['username'];

        if ($data['role_id'] == 2) {
            return redirect()->route('empleados.index')
                ->with('mensaje_empleado', ['primary', __("Empleado $username editado como Contable correctamente")]);
        }
        else if ($data['role_id'] == 3) {
            return redirect()->route('empleados.index')
                ->with('mensaje_empleado', ['primary', __("Empleado $username editado como Mozo de almacén correctamente")]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // Eliminamos al empleado aplicando Soft Delete
        /*$empleado = User::find($id)->delete();
        $username = $empleado->username;*/

        /*$empleado = DB::table('users')->where('id', $id)->select('role_id')->get();
        dd($empleado);*/

        User::find($id)->delete();
        return back()->with('mensaje_empleado', ['danger', __("Empleado eliminado correctamente")]);

        /*if ($empleado->role_id == 2) {
            return back()->with('mensaje_empleado',
                ['danger', __("Contable eliminado correctamente")]);
        }
        else if ($empleado->role_id == 3) {
            return back()->with('mensaje_empleado',
                ['danger', __("Mozo de almacén eliminado correctamente")]);
        }*/
    }
}
