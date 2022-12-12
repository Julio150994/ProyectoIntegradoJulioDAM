import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { LoadingController, AlertController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class PaypalService {
  apiUrl = environment.landgameService;
  token: any;
  pedido: any;
  detallePedido: any;
  carritoCliente: any[] = [];


  constructor(private httpPay: HttpClient, private loadingCtrl: LoadingController,
      private alertCtrl: AlertController) { }


  /** Para añadir nuestro pedido después de realizar el pago */
  aniadirPedido(token: any, precioTotal: number, fechaCompra: any, clienteId: any,
      estado: string) {
    return new Promise(res => {
      this.httpPay.post<any>(this.apiUrl+'/pedidos?precioTotal='+precioTotal+'&fechaCompra='+
        fechaCompra+'&cliente_id='+clienteId+'&estado='+estado, {
          headers: new HttpHeaders().set('Authorization','Bearer '+token)
        }).subscribe(data => {
            console.log(data);
            this.pedido = data;
            res(this.pedido);
            console.log('Pedido añadido correctamente');
        }, error => {
          console.log('Error al añadir este pedido. '+error);
        });
    });
  }

  aniadirDetallePedido(token: any, cantidad: number, precioUnitario: number, pedidoId: any,
      juegoId: any) {
    return new Promise(res => {
      this.httpPay.post<any>(this.apiUrl+'/detallespedidos?cantidad='+cantidad+'&precioUnitario='+
        precioUnitario+'&pedido_id='+pedidoId+'&juego_id='+juegoId, {
          headers: new HttpHeaders().set('Authorization','Bearer '+token)
        }).subscribe(data => {
            console.log(data);
            this.detallePedido = data;
            res(this.detallePedido);
            console.log('Detalle de pedido añadido correctamente');
        }, error => {
          console.log('Error con este detalle del pedido. '+error);
        });
    });
  }
}
