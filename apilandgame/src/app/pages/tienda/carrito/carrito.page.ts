import { Component,OnInit } from '@angular/core';
import { NavController, AlertController, LoadingController } from '@ionic/angular';
import { TiendaService } from '../../../services/tienda.service';
import { CarritoService } from '../../../services/carrito.service';


@Component({
  selector: 'app-carrito',
  templateUrl: './carrito.page.html',
  styleUrls: ['./carrito.page.scss'],
})
export class CarritoPage implements OnInit {
  token: any;
  idJuego!: any;
  contador!: number;
  juegos: any;
  encontrado: any;
  data: any[] = [];
  juego: any;// llamamos a la interface de los juegos de mesa
  cantidad: any;
  cantidadReal = false;
  cantidades: any[] = [];
  juegoEncontrado!: any;// para aumentar o disminuir cantidad a comprar
  cantidadJuegos!: number;
  precioUnidad: any;// para el precio que tenemos por cantidad de juegos
  precioUnitario: any;
  precioTotalCompra: any;


  constructor(private navCtrl: NavController, private alertCtrl: AlertController,
    private loadingCtrl: LoadingController, private tiendaService: TiendaService,
    private carritoService: CarritoService) {}


  ngOnInit() {
    this.token = localStorage.getItem('token');
    // Recibimos el valor de la otra variable del servicio
    this.idJuego = this.tiendaService.getIdJuego();

    this.verJuegoTienda(this.idJuego, this.token);

    this.cantidadJuegos = 1;
    this.precioUnitario = this.tiendaService.getPrecio();// para inicializar el precio obtenido
  }


  async verJuegoTienda(idJuego: number, token: any) {
    await this.tiendaService.obtenerJuego(idJuego, token)
    .then(data => {
      this.encontrado = data;
      this.juego = this.encontrado.success;

      // Recorremos los datos de un solo juego seleccionado
      for (let indice = 0; indice < this.juego?.length; indice++) {
        this.data.push(this.juego[indice]);
      }

      /** Para obtener solamente el precio del juego seleccionado */
      for (let indice = 0; indice < this.juego?.length; indice++) {
        this.tiendaService.setPrecio(this.juego[indice]["precio"]);// establecemos el precio unitario inicial del juego
      }
    });
  }

  backToShop() {
    this.navCtrl.navigateForward('/juegos');
  }

  /** --------- Agregamos juegos al carrito, sumando y restando sus cantidades ---------- */
  sumarCantidad(precio: number) {
    if (this.cantidadJuegos > 0) {
      this.cantidadJuegos += 1;

      precio *= this.cantidadJuegos;
      this.precioUnitario = precio;
      this.precioUnitario.toFixed(2);
    }
  }


  restarCantidad(precio: number) {
    if (this.cantidadJuegos > 1) {
      this.cantidadJuegos -= 1;

      precio *= this.cantidadJuegos
      this.precioUnitario = precio;
      this.precioUnitario.toFixed(2);
    }
  }


  async agregarCarrito(id: number, nombre: string, descripcion: string, imagen: string) {
    this.juegoEncontrado = {
      "id": id,
      "nombre": nombre,
      "descripcion": descripcion,
      "url": imagen,
      "cantidad": this.cantidadJuegos,
      "precioUnitario": this.precioUnitario
    }

    await this.cargarCarrito(this.cantidadJuegos, this.precioUnitario);

    this.carritoService.aniadir({"id": id, "nombre": nombre, "descripcion": descripcion, "url":imagen,
      "cantidad": this.cantidadJuegos, "precioUnitario": this.precioUnitario});// para añadir el juego al carrito


    this.navCtrl.navigateForward('/carrito');// retornamos a la misma página al añadir juego
  }

  /* Mensajes de alerta y carga para el carrito */
  async cargarCarrito(cantidad: number, precio: number) {
    const loadingCliente = await this.loadingCtrl.create({
      message: 'Cargando aplicación...',
      duration: 1000
    });
    await loadingCliente.present();

    const { role, data } = await loadingCliente.onDidDismiss();

    this.alertMessageCarrito(cantidad, precio);
  }


  async alertMessageCarrito(cantidad: number, precio: number) {
    const user = await this.alertCtrl.create({
      header: 'Mensaje de la tienda Landgame',
      cssClass: 'carritoCss',
      message: '<strong>Juego añadido al carrito.</strong>\n<strong><p>Cantidad: '+cantidad+
        '</p><p>Precio: '+precio.toFixed(2)+' €</p></strong>',
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


  verCarritoCompra() {
    this.navCtrl.navigateForward('/compra');
  }
}
