<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ruta para mostrar el menú principal de la tienda Landgame
Route::get('/', 'MenuTiendaController@menu')->name('menu_tienda');

Route::get('/home', 'HomeController@index')->name('home');

/*----------Rutas después de hacer login-----------*/
Auth::routes();


/** ROL_ADMIN */
Route::middleware(["auth", "administrador"])->group(function () {
    // Ficheros de plantilla blade extendidos
    Route::get('/admin', 'AdminController@index')->name('admin.main');
    Route::get('/admin/menu', 'MenuAdminController@index')->name('admin.menus');

    /*-------------Rutas para el CRUD de Clientes-----------------*/
    Route::get('/admin/clientes', 'ClienteController@index')->name('clientes.index');
    Route::get('/admin/clientes/form', 'ClienteController@create')->name('clientes.create');
    Route::post('/admin/clientes', 'ClienteController@store')->name('clientes.store');
    Route::get('/admin/clientes/form/{id}', 'ClienteController@edit')->name('clientes.edit');
    Route::post('/admin/clientes/update/{id}', 'ClienteController@update')->name('clientes.update');
    // Dato: eliminamos en la función del controlador
    Route::get('/admin/clientes/delete/{id}', 'ClienteController@destroy')->name('clientes.destroy');

    /*-------------Rutas para el CRUD de Empleados-----------------*/
    Route::get('/admin/empleados', 'EmpleadoController@index')->name('empleados.index');
    Route::get('/admin/empleados/form', 'EmpleadoController@create')->name('empleados.create');
    Route::post('/admin/empleados', 'EmpleadoController@store')->name('empleados.store');
    Route::get('/admin/empleados/form/{id}', 'EmpleadoController@edit')->name('empleados.edit');
    Route::post('/admin/empleados/update/{id}', 'EmpleadoController@update')->name('empleados.update');
    Route::get('/admin/empleados/delete/{id}', 'EmpleadoController@destroy')->name('empleados.destroy');

    /**---------------Rutas para el CRUD de catálogo de juegos de mesa------------------------- */
    Route::get('/admin/catalogo', 'JuegoController@index')->name('juegos.index');
    Route::get('/admin/catalogo/form', 'JuegoController@create')->name('juegos.create');
    Route::post('/admin/catalogo', 'JuegoController@store')->name('juegos.store');
    Route::get('/admin/catalogo/form/{id}', 'JuegoController@edit')->name('juegos.edit');
    Route::post('/admin/catalogo/update/{id}', 'JuegoController@update')->name('juegos.update');
    Route::get('/admin/catalogo/delete/{id}', 'JuegoController@remove')->name('juegos.remove');
    // Eliminamos una o más imágenes de la tabla juegos (por la tabla imagenes_juegos)
    Route::get('/admin/catalogo/deleteImages/{id}', 'JuegoController@removeImages')->name('juegos.removeImages');

    /**---------------Rutas para el CRUD de empresas de reparto------------------------- */
    Route::get('/admin/empresas-reparto', 'EmpresasRepartoController@index')->name('empresas_reparto.index');
    Route::get('/admin/empresas-reparto/form', 'EmpresasRepartoController@create')->name('empresas_reparto.create');
    Route::post('/admin/empresas-reparto', 'EmpresasRepartoController@store')->name('empresas_reparto.store');
    Route::get('/admin/empresas-reparto/form/{id}', 'EmpresasRepartoController@edit')->name('empresas_reparto.edit');
    Route::post('/admin/empresas-reparto/update/{id}', 'EmpresasRepartoController@update')->name('empresas_reparto.update');
    Route::get('/admin/empresas-reparto/delete/{id}', 'EmpresasRepartoController@destroy')->name('empresas_reparto.destroy');

    Route::get('/pedidos', 'PedidoController@indexPedidosAdmin')->name('admin.pedidos');
    Route::get('/pedidos/verPedido/{id}', 'PedidoController@verPedidoAdmin')->name('admin.detalles_pedido');
    Route::get('/pedidos/modificar/{id}', 'PedidoController@modificarPedidoAdmin')->name('admin.modificar_pedido');
    Route::post('/pedidos/update/{id}', 'PedidoController@updateAdmin')->name('admin.update');


    /**-----------Para listar solamente los pedidos------------------- */
    Route::get('/admin/pedidos', 'PedidoController@indexAdmin')->name('pedidos.indexAdmin');
});


/** ROL CONTABLE */
Route::middleware(["auth", "contable"])->group(function () {
    Route::get('/menu-contable', 'ContableController@menu')->name('contable.menu');
    Route::get('/menu-contable/finanzas', 'PedidoController@indexContable')->name('contable.pedidos');
    Route::post('/menu-contable/finanzas/search', 'PedidoController@buscarPedidos')->name('contable.search');
    Route::get('/menu-contable/finanzas/export', 'PedidoController@exportarPedidosCliente')
        ->name('contable.excel');// para exportar a Excel (extensión .csv)
});


/** ROL MOZO */
Route::middleware(["auth", "mozo"])->group(function () {
    Route::get('/menu-mozo', 'MozoController@menu')->name('mozo.menu');
    Route::get('/menu-mozo/pedidos', 'PedidoController@indexMozo')->name('mozo.pedidos');
    Route::get('/menu-mozo/pedidos/verPedido/{id}', 'PedidoController@verPedido')->name('mozo.detalles_pedido');
    Route::get('/menu-mozo/pedidos/modificar/{id}', 'PedidoController@modificarPedido')->name('mozo.modificar_pedido');
    Route::post('/menu-mozo/pedidos/update/{id}', 'PedidoController@update')->name('mozo.update');
});


/** ROL CLIENTE */
Route::middleware(["auth", "cliente"])->group(function () {
    Route::get('/juego/{id}', 'MenuTiendaController@verJuego')->name('cliente.carrito');

    // Para añadir y/o actualizar cantidad del juego seleccionado utilizando sesiones
    Route::post('/juego/{id}', 'CarritoCompraController@aniadirCarrito')->name('cliente.aniadirCarrito');
    Route::get('/juegos/carrito', 'CarritoCompraController@mostrarCarrito')->name('cliente.juegosCarrito');
    Route::get('/juegos/carrito/delete/{juegoId}', 'CarritoCompraController@eliminarJuegoCarrito')
        ->name('cliente.eliminarJuego');
    Route::get('/juegos/carrito/cleaned', 'CarritoCompraController@limpiarCarrito')->name('cliente.limpiar');

    Route::get('/juegos/carrito/compra', 'PayPalController@mostrarDireccionesEnvio')->name('cliente.compra');// para acceder al formulario de direcciones de envio
    Route::post('/juegos/carrito/store', 'DireccionesEnvioController@aniadirDireccionEnvio')->name('cliente.direccionEnvio');
    Route::get('/juegos/carrito/paypal', 'PayPalController@mostrarVistaPayPal')->name('cliente.paypal');// para acceder a lo del paypal del cliente
    Route::post('/paypal/pago', 'PayPalController@pagarPayPal')->name('cliente.pago');// realizamos el pago
    Route::get('/paypal/estado', 'PayPalController@estadoPayPal')->name('cliente.estado');// para finalizar con el pago a través de PayPal

    // Rutas para editar el perfil del cliente
    Route::get('/perfil-cliente', 'PerfilClienteController@edit')->name('cliente.perfil');
    Route::post('/perfil-cliente/update/{id}', 'PerfilClienteController@update')->name('perfil.update');
});
