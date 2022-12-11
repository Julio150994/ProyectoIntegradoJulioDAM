<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    // RouteServiceProvider::HOME
    protected $redirectTo = '/login';// a la carpeta del login del proyecto

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:40'],
            'apellidos' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:120', 'unique:users'],
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:1|max:70', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['role_id'] = 4;// asignamos el ROL_CLIENTE automáticamente

        return User::create([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id']
        ]);
    }

    /**
     * Create a new user instance for prevent login after registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();
        // Con esto evitamos que el cliente inicie sesión automáticamente
        event(new Registered($cliente = $this->create($request->all())));

        // Mensaje de sesión al registrar clientes
        session()->flash('primary', 'Cliente registrado correctamente');

        return $this->registered($request, $cliente) ?: redirect($this->redirectPath());
    }
}
