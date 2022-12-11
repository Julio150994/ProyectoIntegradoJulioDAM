<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/** ----------- Creamos nuestras rutas para la api rest de Landgame (solamente los clientes) ----------- */
Route::post('register', 'API\ApiAuthController@register');

Route::post('login', 'API\ApiAuthController@login');
Route::post('logout', 'API\ApiAuthController@logout');


Route::get('usuarios', 'API\UsuariosController@obtenerUsuarios');// para obtener los nombres de usuarios

/** Rutas api para nuestra tienda online en el móvil (acceso al administrador y/o a los clientes) */
Route::get('/juegos', 'API\JuegosController@index');

Route::middleware(['auth:api', 'cliente'])->group( function (){
    Route::get('/juego/{id}', 'API\JuegosController@show');

    Route::post('/pedidos', 'API\PedidoController@aniadirPedido');
    Route::post('/detallepedidos', 'API\PedidoController@aniadirDetallePedido');
});
