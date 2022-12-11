<?php

namespace App\Http\Controllers;

use App\ImagenesJuego;
use App\Juego;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class CarritoCompraController extends Controller
{
    /**
     * Display para añadir los juegos al carrito en sí.
     *
     * @return \Illuminate\Http\Response
     */

    public function aniadirCarrito(Request $request, $id) {
        $juegoId = intval($id);//pasamos de dato string a entero

        $idJuego = ($juegoId * 2) - 1;
        $imagenJuego = ImagenesJuego::where('id', $idJuego)->get();

        $juegos = Juego::where('id', $juegoId)->get();

        $this->validate($request, [
                'cantidad' => 'required',
            ],
            ['cantidad.required' => __("Debe introducir una cantidad")]
        );
        
        $data['cantidad'] = $request->input('cantidad');
        $cantidad = intval($data['cantidad']);
        
        $data['precioUnitario'] = $request->input('precioUnitario');
        $formatoPrecio = floatval($data['precioUnitario']) * $cantidad;// poner para formato de dos decimales (fácil)
        $precioUnitario = number_format($formatoPrecio, 2);// formatear a dos decimales desde un inicio

        // Capturamos sesiones añadir los juegos al carrito (con sesiones)
        foreach ($juegos as $juego) {
            $nombre = $juego->nombre;
            $descripcion = $juego->descripcion;
        }

        foreach ($imagenJuego as $img) {
            $imagen = $img->url;
        }

        /** Almacenamos datos en array de sesiones */
        $request->session()->push('juegosCarrito', ['nombre' => $nombre, 'descripcion' => $descripcion,
            'imagen' => $imagen, 'cantidad' => $cantidad, 'precioUnitario' => $precioUnitario, 'juegoId' => $juegoId]);

        $juegoCarrito = $request->session()->get('juegosCarrito');

        foreach ($juegoCarrito as $juego) {
            if (intval($juegoId) == $juego['juegoId']) {
                if ($juego['cantidad'] >= 1 && $nombre == $juego['nombre']) {
                    // Añadimos un juego en sesión (sumando uno la cantidad y el precio multiplicandolo)
                    $juego['cantidad'] += 1;
                    $juego['precioUnitario'] *= $juego['cantidad'];
                }
                else {
                    $juego['cantidad'] = 1;
                }
            }
        }

        return redirect()->route('cliente.carrito', $juegoId)->with('sesion_carrito', [$cantidad, $precioUnitario]);
    }

    /**
     * Display para realizar los procedimientos de compra.
     *
     * @return \Illuminate\Http\Response
     */

    public function mostrarCarrito(Request $request) {
        /** Capturamos los juegos existentes para mostrarlos en la tabla, todo en sesión */
        $clienteId = $request->session()->get('cliente');
        $juegoCarrito = $request->session()->get('juegosCarrito');

        if (is_array($juegoCarrito) && !empty($juegoCarrito)) {
            $precios = array();
            $cantidades = array();

            foreach ($juegoCarrito as $juego) {
                array_push($cantidades, $juego['cantidad']);
                array_push($precios, $juego['precioUnitario']);
            }

            $sumaCantidades = array_sum($cantidades);
            $request->session()->put('sumaCantidades', $sumaCantidades);

            $sumaPrecios = array_sum($precios);
            $request->session()->put('sumaPrecios', $sumaPrecios);// para evitar que la suma anterior se mantenga
        }

        return view('cliente.compra', compact('juegoCarrito'));
    }

    public function eliminarJuegoCarrito(Request $request, $juegoId) {
        $juegoCarrito = $request->session()->get('juegosCarrito');
        
        foreach ($juegoCarrito as $juego) {
            $nombre = $juego['nombre'];
            $descripcion = $juego['descripcion'];
            $imagen = $juego['imagen'];

            if (intval($juegoId) == $juego['juegoId']) {
                $auxPrecio = $juego['precioUnitario'];

                if ($juego['cantidad'] > 0) {
                    /* Eliminamos un juego por id en sesión (restando una cantidad de ese mismo juego) */
                    $juego['cantidad'] -= 1;

                    $precio = $juego['precioUnitario'] - $auxPrecio;
                    $precioUnitario = number_format($precio, 2);
                    $juego['precioUnitario'] = $precioUnitario;

                    // Eliminamos un elemento del elemento de la sesión de la lista de juegos
                    /*$request->session()->forget('juegosCarrito', ['nombre' => $nombre, 'descripcion' => $descripcion,
                        'imagen' => $imagen, 'cantidad' => $juego['cantidad'],
                        'precioUnitario' => $juego['precioUnitario'], 'juegoId' => $juegoId]);*/
                    
                    /** Editamos el juego seleccionado al eliminar del carrito cantidad y precioUnitario anteriores */
                    $request->session()->push('juegosCarrito', ['nombre' => $nombre, 'descripcion' => $descripcion,
                        'imagen' => $imagen, 'cantidad' => $juego['cantidad'],
                        'precioUnitario' => $juego['precioUnitario'], 'juegoId' => $juegoId]);
                    
                    
                    return redirect()->route('cliente.compra')
                        ->with('mensaje_compra', ['danger', __("Juego $nombre eliminado de su carrito")]);
                }
                else if ($juego['cantidad'] == 0) {
                    /** Editamos el juego seleccionado al eliminar del carrito cantidad y precioUnitario anteriores */
                    $request->session()->pull('juegosCarrito', ['nombre' => $nombre, 'descripcion' => $descripcion,
                        'imagen' => $imagen, 'cantidad' => $juego['cantidad'],
                        'precioUnitario' => $juego['precioUnitario'], 'juegoId' => $juegoId]);

                    return redirect()->route('cliente.compra')
                        ->with('mensaje_compra', ['danger', __("Juegos ".$juego['nombre']." eliminado de su carrito")]);
                }
            }
        }
    }

    public function limpiarCarrito(Request $request) {
        /** Obtenemos nuevamente todos los juegos de mesa de la sesión */
        $juegoCarrito = $request->session()->get('juegosCarrito');
        
        if (is_array($juegoCarrito) && !empty($juegoCarrito)) {
            $request->session()->forget('juegosCarrito');
        }

        return redirect()->route('cliente.compra')
            ->with('mensaje_compra', ['danger', __("Todos los juegos eliminados de su carrito")]);
    }

    public function comprarJuegos(Request $request) {
        $juegoCarrito = $request->session()->get('juegosCarrito');

        if (is_array($juegoCarrito) && !empty($juegoCarrito)) {
            $precios = array();
            $cantidades = array();

            foreach ($juegoCarrito as $juego) {
                array_push($cantidades, $juego['cantidad']);
                array_push($precios, $juego['precioUnitario']);
            }

            $sumaCantidades = array_sum($cantidades);
            $cantidadJuegos = $request->session()->get('sumaCantidades');

            $sumaPrecios = array_sum($precios);
            $precioTotalCompra = $request->session()->get('sumaPrecios');
        }

        return view('cliente.paypal', compact('cantidadJuegos', 'precioTotalCompra'));
    }
}
