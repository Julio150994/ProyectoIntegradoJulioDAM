import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { TiendaService } from '../../services/tienda.service';

@Component({
  selector: 'app-inicio',
  templateUrl: './inicio.page.html',
  styleUrls: ['./inicio.page.scss'],
})
export class InicioPage implements OnInit {
  juegos: any;
  juegosMesa: any;
  listaJuegos: any[] = [];
  nombreJuego!: string;

  
  constructor(private navCtrl: NavController, private tiendaService: TiendaService) { }


  ngOnInit() {
    console.log('Menú de inicio de la aplicación Landgame');
    this.obtenerJuegos();
  }

  /** Para visualizar el formulario de login y el registro de clientes */
  getFormularioLogin() {
    this.navCtrl.navigateForward('/login');
  }

  getFormularioRegister() {
    this.navCtrl.navigateForward('/register');
  }

  /** Para realizar el buscador por nombre de juego */
  buscarJuego(juego: any) {
    this.nombreJuego = juego.target.value;
  }


  /** Para mostrar los juegos sin iniciar sesión */
  async obtenerJuegos() {
      await this.tiendaService.mostrarJuegos("")
      .then(data => {
        this.juegosMesa = data;
        this.juegosMesa = this.juegosMesa.success;
        this.juegos = this.juegosMesa;
  
        for (let indice = 0; indice < this.juegos?.length; indice++) {
          this.listaJuegos.push(this.juegos[indice]);
        }
      });
  }
}
