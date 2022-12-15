import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { LoadingController, AlertController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class CarritoService {
  apiUrl = environment.landgameService;
  token: any;
  carritoCliente: any[] = [];// para meter los juegos dentro del array
  juego: any;
  verJuegos: any;
  precioTotal!: number;
  listaPrecios: any[] = [];
  sumaTotal: any;
  juegoCarrito: any;
  indiceObtenido: any;


  constructor(private httpCarrito: HttpClient, private loadingCtrl: LoadingController,
      private alertCtrl: AlertController) { }

  /** Métodos para el servicio de nuestro carrito "en sesión" */

  mostrar() {
    return this.carritoCliente;
  }

  aniadir(juego: any) {
    this.carritoCliente.push(juego);// establecemos un juego
  }

  eliminar(juegoObtenido: any, nombreJuego: string) {
    // Mensaje de confirmación antes de eliminar el juego seleccionado
    this.mensajeConfirmacionEliminarJuego(juegoObtenido, nombreJuego);
  }

  limpiar() {
    // Cargamos el mensaje de confirmación
    this.mensajeConfirmacionLimpiar();
  }

  comprar() {
    // Sumamos los precios de nuestros juegos del carrito para obtener el precio total de compra

    for (let indice = 0; indice < this.carritoCliente?.length; indice++) {
      this.listaPrecios.push(this.carritoCliente[indice]["precioUnitario"]);
    }

    let sumaPrecios = 0.0;

    this.listaPrecios.forEach(function(numero) {
        sumaPrecios += numero;
    });

    this.sumaTotal = sumaPrecios.toFixed(2);// formateamos el total a dos decimales
    this.setTotalCompra(this.sumaTotal);
  }

  pagarCompra() {
    this.carritoCliente = [];// al pagar la compra eliminamos todos los juegos del carrito
  }



  /** Establecemos y obtenemos el juego seleccionado del carrito */
  public setIdJuegoCarrito(juegoId: number, token: any){
    this.juegoCarrito = juegoId;
    this.token = token;
  }

  public getIdJuegoCarrito() {
    return this.juegoCarrito;
  }


  /** Establecemos y obtenemos la suma de los precios */
  public setTotalCompra(precio: number){
    this.precioTotal = precio;
  }

  public getTotalCompra() {
    return this.precioTotal;
  }


  /** Mensaje de confirmación antes de limpiar el carrito */
  async mensajeConfirmacionLimpiar() {
    const carrito = await this.alertCtrl.create({
      header: 'Mensaje de confirmación',
      cssClass: 'carritoCss',
      message: '<strong>¿Desea eliminar todos los juegos de su carrito?</strong>',
      buttons: [
        {
          text: 'Sí',
          role: 'accept',
          cssClass: 'primary',
          handler: (valid) => {
            this.cargarLimpiarCarrito();// para realizar la limipieza de su carrito
          }
        },
        {
          text: 'No',
          role: 'cancel',
          cssClass: 'danger',
          handler: (valid) => { }
        }
      ]
    });

    await carrito.present();
  }


  async mensajeConfirmacionEliminarJuego(juegoObtenido: any, nombre: string) {
    const carrito = await this.alertCtrl.create({
      header: 'Mensaje de confirmación',
      cssClass: 'carritoCss',
      message: '<strong>¿Desea eliminar juego de mesa '+nombre+' del carrito?</strong>',
      buttons: [
        {
          text: 'Sí',
          role: 'accept',
          cssClass: 'primary',
          handler: (valid) => {
            this.cargarEliminarJuego(juegoObtenido, nombre);// para realizar la limipieza de su carrito
          }
        },
        {
          text: 'No',
          role: 'cancel',
          cssClass: 'danger',
          handler: (valid) => { }
        }
      ]
    });

    await carrito.present();
  }


  /** Mensajes de alerta para el cliente */

  async cargarEliminarJuego(juegoObtenido: any, nombre: string) {
    const carrito = await this.loadingCtrl.create({
      message: 'Cargando carrito...',
      duration: 700
    });
    await carrito.present();

    const { role, data } = await carrito.onDidDismiss();

    this.alertEliminarJuego(juegoObtenido, nombre);
  }


  async cargarLimpiarCarrito() {
    const carrito = await this.loadingCtrl.create({
      message: 'Cargando carrito...',
      duration: 700
    });
    await carrito.present();

    const { role, data } = await carrito.onDidDismiss();

    this.alertLimpiarCarrito();
  }


  async alertEliminarJuego(juegoObtenido: any, nombre: string) {
    const user = await this.alertCtrl.create({
      header: 'Mensaje para el cliente',
      cssClass: 'carritoCss',
      message: '<strong>Juego de mesa '+nombre+' eliminado de su carrito correctamente</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => {}
        }
      ]
    });
    await user.present();


    for (let indice = 0; indice < this.carritoCliente?.length; indice++) {
      if (juegoObtenido == this.carritoCliente[indice]) {
        this.carritoCliente.splice(indice, 1);// para eliminar el juego de mesa obtenido con cantidad a eliminar 1
      }
    }
  }


  async alertLimpiarCarrito() {
    const user = await this.alertCtrl.create({
      header: 'Mensaje para el cliente',
      cssClass: 'carritoCss',
      message: '<strong>Se han eliminado todos los juegos de su carrito</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => {
            window.location.reload();
          }
        }
      ]
    });
    await user.present();

    this.carritoCliente = [];
  }
}
