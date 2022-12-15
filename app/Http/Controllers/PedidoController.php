<?php

namespace App\Http\Controllers;

use App\DetallePedido;
use App\Exports\DetallePedidoExport;
use App\ImagenesJuego;
use Illuminate\Http\Request;
use App\Pedido;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
//use PhpOffice\PhpSpreadsheet\IOFactory;


class PedidoController extends Controller {


    /**
     * Display a listing of the resource pedidos for mozo.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexMozo() {
        // Mostramos todos los pedidos de mesa en orden descendente
        $pedidos = Pedido::orderBy('id', 'DESC')->get();
        return view('mozo.pedidos', compact('pedidos'));
    }

    /**
     * Display a listing of the resource verPedido for mozo.
     *
     * @return \Illuminate\Http\Response
     */

    public function verPedido(Request $request, $id) {
        // Aquí visualizamos el estado del pedido principalmente y sus detalles
        $status = Pedido::select('estado')->where('id', $id)->get();

        foreach ($status as $pedido) {
            $estadoPedido = $pedido->estado;

            $detallesPedido = DetallePedido::where('pedido_id', $id)->get();

            $imagenesJuego = ImagenesJuego::orderBy('id', 'ASC')
                ->groupBy('juego_id')
                ->get();

            return view('mozo.detalles_pedido', compact('estadoPedido', 'detallesPedido', 'imagenesJuego'));
        }
    }


    /**
     * Display a form edit estadoPedido access for mozo.
     *
     * @return \Illuminate\Http\Response
     */

    public function modificarPedido($id) {
        // Aqui accedemos al formulario de modificar el estado del pedido
        $pedido = Pedido::find($id);

        $auxEstado = array('Pagado', 'En trámite', 'Preparado', 'Enviado', 'Incidencia');
        $getPedidos = Pedido::where('id', $id)->get();

        $getEstadoPedido = Pedido::where('id', $id)->orderBy('id', 'ASC')->get();

        foreach ($getEstadoPedido as $data) {
            $estadoActual = $data->estado;
            return view('mozo.modificar_pedido', compact('pedido', 'getPedidos', 'auxEstado', 'estadoActual'));
        }
    }


    /**
     * Display a listing of the resource modificarPedido for mozo.
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id) {
        /** Aquí modificamos solamente el estado del pedido */

        // Validaciones del estado del pedido
        $this->validate($request, [
                'estado' => 'required'
            ],
            ['estado.required' => __("Debe seleccionar un estado para su pedido")]
        );

        // Aquí modificamos el estado seleccionando uno del select del formulario
        $data['estado'] = $request->input('estado');

        DB::table('pedidos')->where('id', $id)->update([
            'estado' => $data['estado']
        ]);

        $estadoPedido = $data['estado'];

        return redirect()->route('mozo.pedidos')
            ->with('mensaje_pedido', ['primary', __("Estado de pedido modificado a $estadoPedido correctamente")]);
    }

     /**
     * Display a listing of the resource pedidos for mozo.
     *
     * @return \Illuminate\Http\Response
     */

     public function indexPedidosAdmin() {
        // Mostramos todos los pedidos de mesa en orden descendente
        $pedidos = Pedido::orderBy('id', 'DESC')->get();
        return view('admin.pedidos', compact('pedidos'));
    }

    /**
     * Display a listing of the resource verPedido for mozo.
     *
     * @return \Illuminate\Http\Response
     */

    public function verPedidoAdmin(Request $request, $id) {
        // Aquí visualizamos el estado del pedido principalmente y sus detalles
        $status = Pedido::select('estado')->where('id', $id)->get();

        foreach ($status as $pedido) {
            $estadoPedido = $pedido->estado;

            $detallesPedido = DetallePedido::where('pedido_id', $id)->get();

            $imagenesJuego = ImagenesJuego::orderBy('id', 'ASC')
                ->groupBy('juego_id')
                ->get();

            return view('admin.detalles_pedido', compact('estadoPedido', 'detallesPedido', 'imagenesJuego'));
        }
    }


    /**
     * Display a form edit estadoPedido access for mozo.
     *
     * @return \Illuminate\Http\Response
     */

    public function modificarPedidoAdmin($id) {
        // Aqui accedemos al formulario de modificar el estado del pedido
        $pedido = Pedido::find($id);

        $auxEstado = array('Pagado', 'En trámite', 'Preparado', 'Enviado', 'Incidencia');
        $getPedidos = Pedido::where('id', $id)->get();

        $getEstadoPedido = Pedido::where('id', $id)->orderBy('id', 'ASC')->get();

        foreach ($getEstadoPedido as $data) {
            $estadoActual = $data->estado;
            return view('admin.modificar_pedido', compact('pedido', 'getPedidos', 'auxEstado', 'estadoActual'));
        }
    }


    /**
     * Display a listing of the resource modificarPedido for mozo.
     *
     * @return \Illuminate\Http\Response
     */

    public function updateAdmin(Request $request, $id) {
        /** Aquí modificamos solamente el estado del pedido */

        // Validaciones del estado del pedido
        $this->validate($request, [
                'estado' => 'required'
            ],
            ['estado.required' => __("Debe seleccionar un estado para su pedido")]
        );

        // Aquí modificamos el estado seleccionando uno del select del formulario
        $data['estado'] = $request->input('estado');

        DB::table('pedidos')->where('id', $id)->update([
            'estado' => $data['estado']
        ]);

        $estadoPedido = $data['estado'];

        return redirect()->route('admin.pedidos')
            ->with('mensaje_pedido', ['primary', __("Estado de pedido modificado a $estadoPedido correctamente")]);
    }


    /**
     * Display a listing of the resource pedidos for contable.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexContable(Request $request) {
        $fechaInicio = ""; $fechaFinal = "";

        // Mostramos todos los pedidos de mesa en orden descendente
        $pedidos = Pedido::orderBy('id', 'DESC')
            ->where('estado', '=', 'Enviado')
            ->get();

        return view('contable.pedidos', compact('pedidos', 'fechaInicio', 'fechaFinal'));
    }

    /**
     * Display a search of the resource pedidos for contable.
     *
     * @return \Illuminate\Http\Response
     */

    public function buscarPedidos(Request $request) {
        $formatoFechaInicio = $request->input('fechaInicio');
        $fechaInicio = date("d/m/Y", strtotime($formatoFechaInicio));

        $formatoFechaFinal = $request->input('fechaFinal');
        $fechaFinal = date("d/m/Y", strtotime($formatoFechaFinal));

        /**
         *  Mostramos los pedidos que están filtrados entre dos fechas
         * (a través del campo fechaCompra) y que tengan estado enviado
         */

        if ($request->get('fechaInicio') && $request->get('fechaFinal')) {
            $pedidos = Pedido::whereBetween('fechaCompra', [$formatoFechaInicio, $formatoFechaFinal])
                ->where('estado', '=', 'Enviado')
                ->orderBy('id', 'DESC')
                ->get();

            foreach ($pedidos as $pedido) {
                $clienteId = $pedido->cliente_id;// obtenemos el id del cliente que ha comprado un pedido

                // Utilizamos sesiones para pasar las fecha inicio y final de un método a otro del controlador
                $request->session()->put(['fechaInicio' => $formatoFechaInicio]);
                $request->session()->put(['fechaFinal' => $formatoFechaFinal]);
            }
        }
        return view('contable.pedidos', compact('pedidos', 'fechaInicio', 'fechaFinal'));
    }

    /**
     * Display a listing of the resource pedidos export in Excel document contable.
     *
     * @return \Illuminate\Http\Response
     */

    public function exportarPedidosCliente() {
        $xlsx = 'pedidos_cliente.xlsx';// nombre del xlsx

        return Excel::download(new DetallePedidoExport, $xlsx);
    }
}
