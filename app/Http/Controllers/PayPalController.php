<?php

namespace App\Http\Controllers;

use App\DireccionesEnvio;
use App\EmpresasReparto;
use App\Pedido;
use App\Mail\EmailLandgame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;


class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $configuracionPayPal = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $configuracionPayPal['client_id'] = 'AZvN1GcB42pI9neFzkOqHwVVKlm7yXuAlEI0dpBaSL_vPoTLgW9FE_N4KTP-ulxEjbTQwmizK4meZgAn',
                $configuracionPayPal['secret'] = 'EMQdcVdJ3WsiQ2OmwVJZvOdeHeG8oj7FZAUSSwacVDH9pEn83nudXwEL9dvzED3nTm4uMlSrnIIH7bcq'
            )
        );
        
        $this->apiContext->setConfig(
            array(
                'mode' => env('PAYPAL_MODE', 'sandbox'),
                'http.ConnectionTimeOut' => 30,
                'log.LogEnabled' => true,
                'log.FileName' => storage_path('/logs/paypal.log'),
                'log.LogLevel' => 'ERROR'
            )
        );
    }

    public function mostrarVistaPayPal(Request $request) {
        $clienteId = Auth::user()->id;// id de cliente actual
        $clienteActual = Auth::user()->username;// nombre de usuario actual

        /** Recogemos la sesión de la suma de los precios del carrito */
        $precioFormateado = $request->session()->get('sumaPrecios');
        $precioTotalCompra = number_format($precioFormateado, 2);// para redondear a dos decimales desde el controlador

        /** Obtenemos las empresas de reparto y los pedidos */
        $empresasReparto = EmpresasReparto::orderBy('id', 'ASC')->get();
        
        $pedidosCliente = Pedido::where('cliente_id', $clienteId)->get();

        $direccionEnvioCliente = DireccionesEnvio::where('cliente_id', $clienteId)->count();

        return view('cliente.paypal', compact('clienteId', 'clienteActual', 'precioTotalCompra',
            'empresasReparto', 'pedidosCliente', 'direccionEnvioCliente'));
    }

    /**---------Funcionalidades para gestionar la parte del paypal para cada cliente---------*/
    public function pagarPayPal(Request $request) {
        $pagador = new Payer();
        $pagador->setPaymentMethod('paypal');
        $juegosCarrito = $request->session()->get('juegosCarrito');
        
        // Recogemos el precio total de los juegos en un campo de texto de PayPal
        $precioTotalCompra = $request->session()->get('sumaPrecios');

        $montaje = new Amount();
        $montaje->setTotal($precioTotalCompra);
        $montaje->setCurrency('EUR');

        $transaccion = new Transaction();
        $transaccion->setAmount($montaje);
        $transaccion->setDescription('Transacciones realizadas de sus juegos de mesa');

        $urlEstadoPago = url('/paypal/estado');
        $urlCarrito = url('/juegos/carrito');

        $redirectPayPal = new RedirectUrls();
        $redirectPayPal->setReturnUrl($urlEstadoPago)
            ->setCancelUrl($urlCarrito);

        $pago = new Payment();
        $pago->setIntent('sale')
            ->setPayer($pagador)
            ->setTransactions(array($transaccion))
            ->setRedirectUrls($redirectPayPal);
        
        $this->apiContext->getCredential()->getAccessToken(['accessToken']);

        try {
            $pago->create($this->apiContext);
            return redirect()->away($pago->getApprovalLink())->with(compact('precioTotalCompra'));
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function estadoPayPal(Request $request) {
        $juegoCarrito = $request->session()->get('juegosCarrito');// recuperamos los juegos del carrito "comprados"
        $precioTotalCompra = $request->session()->get('sumaPrecios');
        $clienteId = auth()->user()->id;

        $pagoId = $request->input('paymentId');
        $pagadorId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$pagoId || !$pagadorId || !$token ) {
            return redirect()->route('cliente.paypal')
                ->with('paymentStatus', ['danger', __("Lo sentimos! El pago con PayPal no se pudo realizar.")]);
        }
        else {
            $pago = Payment::get($pagoId, $this->apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($pagadorId);

            // Ejecutamos el pago con PayPal
            $resultadoPago = $pago->execute($execution, $this->apiContext);

            if ($resultadoPago->getState() === 'approved') {
                // Compramos los juegos después de que sean pagados por el cliente

                // Añadimos un nuevo pedido al realizar el pago
                $pedido = DB::table('pedidos')->insertGetId([
                    'precioTotal' => $precioTotalCompra,
                    'fechaCompra' => now(),// para obtener la fecha actual (en formato YYYY-mm-dd)
                    'cliente_id' => $clienteId,
                    'estado' => 'Pagado'
                ]);

                foreach ($juegoCarrito as $detallePedido) {
                    // Añadimos todos los juegos de la sesión a la vez "a la tabla de BD detalle pedidos"
                    DB::table('detalle_pedidos')->insert([
                        'cantidad' => $detallePedido['cantidad'],
                        'precioUnitario' => $detallePedido['precioUnitario'],
                        'pedido_id' => $pedido,
                        'juego_id' => $detallePedido['juegoId']
                    ]);
                }

                // Después de pagar por los juegos, eliminamos todos los juegos del carrito
                $request->session()->forget('juegosCarrito');

                // Realizar esto después del pago con PayPal: Servidor email por defecto: MAIL_PORT=2525
                /*$pedidos = User::pluck('email');
                Mail::to($pedidos)->send(new EmailLandgame());*/

                return redirect()->route('menu_tienda')
                    ->with('paymentStatus', ['primary', __("Pago de $precioTotalCompra € con PayPal realizado correctamente.")]);
            }
            else {
                return redirect()->route('cliente.paypal')
                    ->with('paymentStatus', ['warning', __("Pago con PayPal no realizado correctamente.")]);
            }
        }
    }
}
