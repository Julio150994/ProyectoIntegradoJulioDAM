<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id == 4) {
            return $next($request);
        }
        else {
            return redirect()->back()
                ->with("auth_message", "No puedes acceder con otro usuario a partes de los clientes");
        }
    }
}
