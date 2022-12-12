import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { AlertController, NavController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class AuthClientesService {

  apiUrl = environment.landgameService;
  token: any;
  users: any;
  user: any;
  username!: string;
  password!: string;
  datosUsuario: any;
  cliente: any;
  mensajeUsuarios!: string;
  usuarios: any;
  idUsuario!: number;
  id!: number;


  constructor(private httpCliente: HttpClient, private alertUserCtrl: AlertController,
    private navCtrl: NavController) { }


  /** Para registrar nuestros clientes desde el servicio */
  register(nombre: any, apellidos: any, email: any, username: any, password: any, c_password: any) {
      console.log('Contraseña: '+password);
      console.log('Contraseña confirmada: '+c_password);

      return new Promise(resolve => {
        this.httpCliente.post<any>(this.apiUrl+'/register?'+'nombre='+nombre+'&apellidos='+apellidos+
        '&email='+email+'&password='+password, {
        }).subscribe(datoUsuario => {
        console.log(datoUsuario);
        this.cliente = datoUsuario;
        resolve(datoUsuario);

        this.clienteRegistrado(username);

        this.navCtrl.navigateForward('/login');
      }, error => {
        console.log('Error al registrar este usuario '+error);
      });
    });
  }


  login(username: string, password: string) {
    return new Promise(resolve => {
      this.httpCliente.post(this.apiUrl+'/login', {
        username: username,
        password: password
      }).subscribe(data => {
        /* Para cuando este sea usuario cliente */
        console.log(data);
        this.user = data;
        this.datosUsuario = this.user.success;

        // Establecemos el id del usuario obtenido
        this.id = this.datosUsuario.id;
        this.setIdUsuario(this.id);

        this.token = this.datosUsuario.token;
        localStorage.setItem('token', this.token);
        resolve(data);
      }, error => {
          console.error('Error al iniciar sesión con este usuario '+error);
      });
    });
  }

  /** Para mostrar nuestros usuarios sin autorización de token */
  obtenerUsuarios() {
    return new Promise(res => {
      this.httpCliente.get<any>(this.apiUrl+'/usuarios', {
      }).subscribe(data => {
        if (data == null) {
          this.mensajeUsuarios = "No se han encontrado usuarios registrados en la tienda"
        }
        else {
          this.usuarios = data;
          res(data);
        }
      }, error => {
        console.error('Error al mostrar los usuarios '+error);
      });
    });
  }


  /** Mensaje para el nuevo cliente registrado en la tienda */
  async clienteRegistrado(username: string) {
    const registrado = await this.alertUserCtrl.create({
      header: 'Mensaje',
      cssClass: 'registerCss',
      message: '<strong>Cliente '+username+' registrado correctamente.</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (register) => {
          }
        }
      ]
    });
    await registrado.present();
  }


  /** Establecemos y obtenemos el id y el nombre del usuario actual */
  public setIdUsuario(id: number){
    this.idUsuario = id;
  }

  public getIdUsario() {
    return this.idUsuario;
  }


  public setUsername(username: string){
    this.username = username;
  }

  public getUsername() {
    return this.username;
  }
}
