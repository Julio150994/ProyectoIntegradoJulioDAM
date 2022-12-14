import { Component, OnInit, ViewChild } from '@angular/core';
import { AlertController, NavController, LoadingController, IonList } from '@ionic/angular';
import { TiendaService } from '../../services/tienda.service';
import { AuthClientesService } from '../../services/auth-clientes.service';



@Component({
  selector: 'app-juegos',
  templateUrl: './juegos.page.html',
  styleUrls: ['./juegos.page.scss'],
})
export class JuegosPage implements OnInit {
  @ViewChild('landgame', {static: true}) landgame!: IonList;

  token: any;
  mensajeLandgame = "No se han encontrado juegos en la tienda";
  juegosMesa: any;
  juegos: any;
  listaJuegos: any[] = [];
  username: any;
  nombreUsuario!: string;
  datoUsuario: any[] = [];
  nombreJuego!: string;


  constructor(private alertCtrl: AlertController, private navCtrl: NavController,
    private loadingCtrl: LoadingController, private tiendaService: TiendaService,
    private authService: AuthClientesService) {}


  ngOnInit() {
    this.token = localStorage.getItem('token');
    this.nombreUsuario = this.authService.getUsername();// recibimos el nombre de usuario del administrador o el cliente actual
    this.datoUsuario.push(this.nombreUsuario);
    this.username = this.datoUsuario[0];// para mostrarlo siempre en sesión ya almacenado
    this.obtenerJuegos(this.token);
  }


  /** Para realizar el buscador por nombre de juego */
  buscarJuego(juego: any) {
    this.nombreJuego = juego.target.value;
  }


  /** Para cerrar sesión del administrador o el cliente */
  cerrarSesion() {
    localStorage.removeItem('token');// eliminamos el token
    this.cargarLogout(this.username);
  }

  async cargarLogout(username: string) {
    const cliente = await this.loadingCtrl.create({
      message: 'Cargando aplicación...',
      duration: 800
    });

    await cliente.present();

    const { role, data } = await cliente.onDidDismiss();

    // Redireccionamos a la página de login
    this.navCtrl.navigateForward('/login');
    this.alertLogout(username);// después de cargar el cliente
  }


  async alertLogout(username: string) {
    const cliente = await this.alertCtrl.create({
      header: 'Mensaje de la tienda',
      cssClass: 'loginCss',
      message: '<strong>'+username+' ha cerrado sesión correctamente.</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await cliente.present();
  }


  obtenerJuegos(token: any) {
    this.tiendaService.mostrarJuegos(token)
    .then(data => {
      this.juegosMesa = data;
      this.juegosMesa = this.juegosMesa.success;
      this.juegos = this.juegosMesa;

      for (let indice = 0; indice < this.juegos?.length; indice++) {
        this.listaJuegos.push(this.juegos[indice]);
      }
    });
  }

  async seleccionarJuego(id: number) {
    this.tiendaService.setIdJuego(id);// para establecer el id en el servicio
    this.navCtrl.navigateForward('/carrito');
  }
}
