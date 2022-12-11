<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Factura PDF</title>
        {{-- Estilos CSS, no se puede utilizar Bootstrap dentro de un informe PDF con DOMPDF --}}
        <link rel="stylesheet" href="{{ asset('css/facturapdf.css') }}">
    </head>
    
    <body>
        <div>
            <h2 class="titulo">Factura de compra del cliente</h2>

            <div>
                <h3 class="txt-detalle">Detalles del pedido</h3>

                <table class="tabla-pedidos">
                    <thead class="cabecera-tabla">
                        <tr>
                            <th scope="col">Nombre de juego</th>
                            <th scope="col">Descripción de juego</th>
                            <th scope="col">Imágen de juego</th>
                            <th scope="col">Cantidad comprada</th>
                            <th scope="col">Precio unitario</th>
                        </tr>
                    </thead>
                    <tbody class="cuerpo-tabla">
                        <tr>
                            <td>Trivial Pursuit Familia</td>
                            <td>Descripción</td>
                            <td>
                                <img src="{{ asset('images/juegos_mesa/trivial_pursuit_familia.png') }}"
                                    class="imagen-pedido"/>
                            </td>
                            <td>1</td>
                            <td>34.56</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <p>
                    <span class="precio-factura"><strong>Precio total de factura: </strong> <span> €</span></span>
                </p>
            </div>
        </div>
    </body>
</html>