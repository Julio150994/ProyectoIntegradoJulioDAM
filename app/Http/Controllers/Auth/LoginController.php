<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /** Para iniciar sesión con el campo username, en vez de con email */
    public function username() {
        return 'username';
    }


    /** Para evitar los múltiples inicios de sesión */
    public function redirectTo() {
        $user = User::find(auth()->id());

        $rolUsuario = Auth::user()->role_id;// llamamos al numero de rol correspondiente desde la tabla users
        $username = Auth::user()->username;// recogemos el nombre de usuario

        if ($user->is_logged == false) {
            $user->is_logged = true;// iniciamos sesión correctamente
            $user->save();

            if($rolUsuario == 1) {
                // Administrador
                session()->flash('login_admin', 'El administrador ha iniciado sesión correctamente');
                return $this->redirectTo = route('admin.main');
            }
            else if($rolUsuario == 2) {
                // Contable
                session()->flash('login_contable', 'El contable '.$username.' ha iniciado sesión correctamente');
                return $this->redirectTo = route('contable.menu');
            }
            else if($rolUsuario == 3) {
                // Mozo de almacén
                session()->flash('login_mozo', 'El mozo '.$username.' ha iniciado sesión correctamente');
                return $this->redirectTo = route('mozo.menu');
            }
            else if($rolUsuario == 4) {
                // Cliente
                session()->flash('login_cliente', 'El cliente '.$username.' ha iniciado sesión correctamente');
                return $this->redirectTo = route('menu_tienda');
            }
        }
        else {
            /** Para cuando el usuario ya haya iniciado sesión */
            if($user->is_logged == true) {
                $this->guard()->logout(); // Impedimos que inicie sesión a la vez con un mismo nombre de usuario
                session()->invalidate(); // Invalidamos la sesión del usuario
                session()->flash('message_login', ['warning', 'El usuario '.$user->username.' ya ha iniciado sesión']);
                return $this->redirectTo = route('login');
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /** Para cerrar la sesión correctamente con cualquier usuario */

     public function logout(Request $request) {
        $usuario = User::find(auth()->id());
        $usuario->is_logged = false;
        $usuario->save();

        $this->guard()->logout();

        return $this->loggedOut($request) ?: redirect('/');
     }

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */

    protected function loggedOut(Request $request) {
        session()->invalidate();// para invalidar la sesión
        return redirect('/')->with('logout', ['primary', __("Ha cerrado sesión correctamente")]);
    }
}
