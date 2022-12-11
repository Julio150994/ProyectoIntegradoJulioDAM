<?php

namespace App\Http\Controllers;

use App\DetallePedido;
use App\DireccionesEnvio;
use App\EmpresasReparto;
use App\ImagenesJuego;
use App\Pedido;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DireccionesEnvioController extends Controller
{
     /**
     * Display a añadir dirección de envio of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function aniadirDireccionEnvio(Request $request) {
        $clienteId = auth()->user()->id;// id de cliente actual
        $clienteUsername = auth()->user()->username;

        // Validamos la dirección de envio
        $this->validate($request, [
                'direccion' => 'required|max:140',
                'nombreCalle' => 'required|max:85',
                'portal' => 'required',
                'piso' => 'required|max:20',
                'codigoPostal' => 'required',
                'ciudad' => 'required|max:60',
                'provincia' => 'required|max:80',
                'pais' => 'required|max:70',
                'telefono' => 'required|min:9|max:9|unique:direcciones_envios',
                'observaciones' => 'required|max:120',
                'empresa_reparto_id' => 'required'
            ],
            ['direccion.required' => __("Debe introducir un nombre de cliente")],
            ['direccion.max' => __("La dirección no puede tener más de 140 caracteres")],

            ['nombreCalle.required' => __("Debe introducir unos apellidos de cliente")],
            ['nombreCalle.max' => __("El nombre de calle no puede tener más de 85 caracteres")],
            
            ['portal.required' => __("Debe introducir un email de cliente")],

            ['piso.required' => __("Debe introducir el número de piso")],
            ['piso.max' => __("Este dato no debe tener más de 20 caracteres")],

            ['codigoPostal.required' => __("Debe introducir su código postal")],

            ['ciudad.required' => __("Debe introducir su ciudad")],
            ['ciudad.max' => __("La ciudad no debe tener más de 60 caracteres")],

            ['provincia.required' => __("Debe introducir la provincia")],
            ['provincia.max' => __("La provincia no debe tener más de 80 caracteres")],
            
            ['pais.required' => __("Debe introducir el pais")],
            ['pais.max' => __("El país no debe tener más de 70 caracteres")],

            ['telefono.required' => __("Debe introducir su número de teléfono")],
            ['telefono.min' => __("Su número de teléfono debe tener 9 caracteres")],
            ['telefono.max' => __("Su número de teléfono debe tener 9 caracteres")],

            ['observaciones.required' => __("Debe introducir sus observaciones")],
            ['observaciones.max' => __("Sus observaciones no deben tener más de 120 caracteres")],

            ['empresa_reparto_id.required' => __("Debe seleccionar una empresa de envio de las existentes")]
        );

        // Añadimos la nueva dirección de envío
        $data['direccion'] = $request->input('direccion');
        $data['nombreCalle'] = $request->input('nombreCalle');
        $data['portal'] = $request->input('portal');
        $data['piso'] = $request->input('piso');
        $data['codigoPostal'] = $request->input('codigoPostal');
        $data['ciudad'] = $request->input('ciudad');
        $data['provincia'] = $request->input('provincia');
        $data['pais'] = $request->input('pais');
        $data['telefono'] = $request->input('telefono');
        $data['observaciones'] = $request->input('observaciones');

        $empresa_reparto_id = $request->input('empresa_reparto_id');
        $data['empresa_reparto_id'] = intval($empresa_reparto_id);

        $data['cliente_id'] = $clienteId;

        DB::table('direcciones_envios')->insert($data);

        /** Editamos el precio del pedido al introducir el nuevo dato */
        
        
        return redirect()->route('cliente.paypal')
            ->with('paymentStatus', ['primary', __("Dirección de envio añadida correctamente para $clienteUsername")]);
    }


    /**
     * Display a generar factura en pdf of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function generarFactura(Request $request) {
        $clienteId = auth()->user()->id;
        $clienteActual = auth()->user()->username;

        // Mostrar la factura del último pedido que ha realizado el propio cliente
        $pedidosCliente = Pedido::where('cliente_id', $clienteId)->orderBy('id', 'DESC')->get();

        foreach ($pedidosCliente as $pedido) {
            $detallesPedido = DetallePedido::where('pedido_id', $pedido->id)
                ->orderBy('id', 'DESC')
                ->get();

            $precioFormateado = $pedido->precioTotal;
            
            // Redondeamos a dos decimales el precio desde el controlador
            $precioTotalCompra = number_format($precioFormateado, 2);
            dd($precioTotalCompra);

            /*$imagenesJuego = ImagenesJuego::orderBy('id', 'ASC')
                ->groupBy('juego_id')
                ->get();*/

            //$empresasReparto = EmpresasReparto::orderBy('id', 'ASC')->get();

            // Mostramos la última dirección de envio que ha introducido el cliente,
            // que se corresponda con el pedido generado
            $direccionEnvioCliente = DireccionesEnvio::where('cliente_id', $clienteId)->latest()->get();

            $factura = [
                /*'titulo' => 'Factura de compra para '.$clienteActual.' generada',
                'tituloDetalle' => 'Detalles del pedido',
                'tituloDireccionEnvio' => 'Dirección de envio de pedido',
                'idPedido' => $pedido->id,
                'detallesPedido' => $detallesPedido,*/
                'totalFactura' => $precioTotalCompra
                //'imagenesJuego' => $imagenesJuego,
                //'empresasReparto' => $empresasReparto,
                //'direccionesEnvioCliente' => $direccionEnvioCliente
            ];

            /*$vistaPDF = view('cliente.factura_pdf')
                ->with('titulo', 'Factura de compra para '.$clienteActual.' generada')
                ->with('tituloDetalle', 'Detalles de la factura')
                ->with('tituloDireccionEnvio', 'Dirección de envio de pedido')
                ->with('pedido', $pedido)
                ->with('idPedido', $pedido->id)
                ->with('detallesPedido', $detallesPedido)
                ->with('totalFactura', $precioTotalCompra)
                ->with('imagenesJuego', $imagenesJuego)
                ->with('empresasReparto', $empresasReparto)
                ->with('direccionesEnvioCliente', $direccionEnvioCliente);*/

            
            $facturaPDF = \PDF::loadView('cliente.factura_pdf', $factura);

            // Para crear un pdf en el navegador usaremos la siguiente línea (opción de prueba)
            return $facturaPDF->stream();// para probarlo una y otra vez
            
            // Para descargar el PDF (la mejor opción)
            //return $facturaPDF->download('factura_'.$clienteActual.'.pdf');
        }
    }
}
