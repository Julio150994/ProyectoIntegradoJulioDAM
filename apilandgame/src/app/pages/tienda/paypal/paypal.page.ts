import { Component, OnInit } from '@angular/core';
import { AlertController, LoadingController, NavController } from '@ionic/angular';
import { CarritoService } from '../../../services/carrito.service';
import { PaypalService } from '../../../services/paypal.service';
import { AuthClientesService } from '../../../services/auth-clientes.service';


@Component({
  selector: 'app-paypal',
  templateUrl: './paypal.page.html',
  styleUrls: ['./paypal.page.scss'],
})
export class PaypalPage implements OnInit {
  precioTotalCompra: any;
  juegosCarrito: any;
  carrito: any;
  token: any;

  precioTotal!: number;
  fechaCompra: any;
  clienteId!: number;
  estado!: string;
  cantidad!: number;
  precioUnitario!: number;
  pedidoId: any;
  juegoId!: number;
  fechaActual: any[] = [];
  nuevoPedido: any;


  constructor(private navCtrl: NavController, private carritoService: CarritoService,
      private alertCtrl: AlertController, private loadingCtrl: LoadingController,
      private authService: AuthClientesService, private payService: PaypalService) { }


  ngOnInit() {
    this.token = localStorage.getItem('token');

    this.precioTotalCompra = this.carritoService.getTotalCompra();// precio total de la compra
    this.juegosCarrito = this.carritoService.mostrar();
  }

  /** ------------  Para realizar el pago de nuestro pedido desde el móvil  --------------------- */
  realizarPago() {
    this.cargarPago();
  }


  /** Para volver a la vista de los juegos del carrito */
  backToCarrito() {
    this.navCtrl.navigateForward('/compra');
  }


  /** Mensajes de alerta después de comprar los juegos de mesa */

  async cargarPago() {
    const loadingpay = await this.loadingCtrl.create({
      message: 'Cargando aplicación...',
      duration: 800
    });
    await loadingpay.present();

    const { role, data } = await loadingpay.onDidDismiss();

    this.precioTotalCompra = this.carritoService.getTotalCompra();
    this.juegosCarrito = this.carritoService.mostrar();

    // Añadimos el pedido con sus datos correspondientes, junto con sus detalles
    this.estado = "Pagado";

    const fecha = new Date();
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    this.fechaActual.push(anio, mes, dia);

    this.fechaCompra = this.fechaActual[0]+"-"+this.fechaActual[1]+"-"+this.fechaActual[2];
    this.clienteId = this.authService.getIdUsario();

    this.nuevoPedido = await this.payService.aniadirPedido(this.token, this.precioTotalCompra, this.fechaCompra, this.clienteId, this.estado);


    for (let indice = 0; indice < this.juegosCarrito?.length; indice++) {
      this.cantidad = this.juegosCarrito[indice]["cantidad"];
      this.precioUnitario = this.juegosCarrito[indice]["precioUnitario"];
      this.pedidoId = this.nuevoPedido.success.id;
      this.juegoId = this.juegosCarrito[indice]["id"];

      await this.payService.aniadirDetallePedido(this.token, this.cantidad, this.precioUnitario, this.pedidoId, this.juegoId);
    }

    this.carritoService.pagarCompra();

    this.alertPago();
    this.navCtrl.navigateForward('/juegos');
  }


  async alertPago() {
    const pay = await this.alertCtrl.create({
      header: 'Mensaje para el cliente',
      cssClass: 'payCss',
      message: '<strong>Has realizado el pago éxitosamente.</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await pay.present();
  }
}
