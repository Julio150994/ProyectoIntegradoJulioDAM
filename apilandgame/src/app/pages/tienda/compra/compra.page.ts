import { Component, OnInit, ViewChild } from '@angular/core';
import { AlertController, LoadingController, NavController, IonList } from '@ionic/angular';
import { CarritoService } from '../../../services/carrito.service';
import { TiendaService } from '../../../services/tienda.service';

@Component({
  selector: 'app-compra',
  templateUrl: './compra.page.html',
  styleUrls: ['./compra.page.scss'],
})
export class CompraPage implements OnInit {
  @ViewChild('compra', {static: true}) compra!: IonList;
  token: any;
  carritoCliente: any[] = [];
  juegosCarrito: any[] = [];
  carritoReal: any[] = [];
  setcarrito: any;
  encontrado: any;
  juego: any;
  datosJuego: any[] = [];
  nombreObtenido!: string;
  juegoId!: number;


  constructor(private alertCtrl: AlertController, private navCtrl: NavController,
    private loadingCtrl: LoadingController, private carritoService: CarritoService,
    private tiendaService: TiendaService) { }


  ngOnInit() {
    this.token = localStorage.getItem('token');

    console.log('Carrito de la compra del cliente');
    this.mostrarJuegosCarrito();
  }

  /** ------- Para volver a agregar juegos al carrito -------- */
  addBackJuego() {
    this.navCtrl.navigateForward('/carrito');
  }

  /** --------- Métodos para gestionar nuestro carrito ------------ */

  mostrarJuegosCarrito() {
    this.carritoCliente = this.carritoService.mostrar();
    console.log(this.carritoCliente);
  }

  limpiarCarrito() {
      this.carritoService.limpiar();
  }

  async eliminarJuegoCarrito(juegoId: any, nombre: string) {
    this.carritoService.setIdJuegoCarrito(juegoId, this.token);

    /** Aquí obtenemos el juego seleccionado para eliminar del carrito (teniendo en cuenta las cantidades) */
    this.juegoId = this.carritoService.getIdJuegoCarrito();

    for (let indice = 0; indice < this.carritoCliente?.length; indice++) {
      if (this.juegoId == this.carritoCliente[indice]["id"]) {

        this.datosJuego = this.carritoCliente[indice];// obtenemos el juego del carrito seleccionado
        this.nombreObtenido = this.carritoCliente[indice]["nombre"];
        this.carritoService.eliminar(this.datosJuego, this.nombreObtenido);
      }
    }
  }

  /* Aquí es donde realizamos la compra y nos redirige a la página de PayPal */
  comprarJuegos() {
    this.cargarCompra();
  }


  async cargarCompra() {
    const loadingCliente = await this.loadingCtrl.create({
      message: 'Cargando carrito...',
      duration: 650
    });
    await loadingCliente.present();

    const { role, data } = await loadingCliente.onDidDismiss();

    this.carritoService.comprar();
    this.navCtrl.navigateForward('/paypal');
    this.alertCompraCliente();
  }


  async alertCompraCliente() {
    const user = await this.alertCtrl.create({
      header: 'Mensaje para el cliente',
      cssClass: 'carritoCss',
      message: '<strong>Compra realizada éxitosamente. Ahora realice el pago</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await user.present();
  }
}
