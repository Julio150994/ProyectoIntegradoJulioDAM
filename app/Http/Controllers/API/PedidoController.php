<?php

namespace App\Http\Controllers\API;

use App\DetallePedido;
use App\Http\Controllers\Controller;
use App\Pedido;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PedidoController extends Controller
{
    /** Para el proceso de compra de los juegos a través del móvil */
    public $apiStatus = [200, 400, 401, 404];

    /**
     * Agregamos a la base de datos los juegos del carrito
     * después de realizar el pago con estas dos funciones
     */

    public function aniadirPedido(Request $request, Pedido $pedido) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'precioTotal' => 'required',
            'fechaCompra' => 'required',
            'cliente_id' => 'required',
            'estado' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], $this->apiStatus[2]);
        }

        $pedido->precioTotal = $input['precioTotal'];
        $pedido->fechaCompra = $input['fechaCompra'];
        $pedido->cliente_id = $input['cliente_id'];
        $pedido->estado = $input['estado'];

        if ($pedido->estado == 'Pagado') {
            $pedido->save();// añadimos el pedido

            return response()->json(['success' => $pedido,
                'message' => 'Pedido añadido correctamente'], $this->apiStatus[0]);
        }
        else {
            return response()->json(['error' => 'Error. El pedido debe tener estado Pagado'], $this->apiStatus[1]);
        }
    }


    public function aniadirDetallePedido(Request $request, DetallePedido $detallePedido) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'cantidad' => 'required',
            'precioUnitario' => 'required',
            'pedido_id' => 'required',
            'juego_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], $this->apiStatus[2]);
        }

        $detallePedido->cantidad = $input['cantidad'];
        $detallePedido->precioUnitario = $input['precioUnitario'];
        $detallePedido->pedido_id = $input['pedido_id'];// este se debe autogenerar en ionic
        $detallePedido->juego_id = $input['juego_id'];// obtener de los juegos
        $detallePedido->save();// añadimos los detalles del pedido

        return response()->json(['success' => $detallePedido,
            'message' => 'Detalle de pedido añadido correctamente'], $this->apiStatus[0]);
    }
}
