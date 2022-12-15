import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators } from '@angular/forms';
import { AlertController, NavController, LoadingController } from '@ionic/angular';
import { AuthClientesService } from '../../services/auth-clientes.service';
import { Buffer } from 'buffer';


@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
  auxtok: any;
  token: any;
  username!: string;
  password!: string;
  datas: any;
  usuarios: any;
  mensaje!: string;

  user = new FormGroup({
    username: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  id: any;
  nombreUsuario = this.username;
  contrasenia = this.password;
  usuario: any;
  dataUsername: any;
  datosUsuarios: any;
  listaUsuarios: any;
  users: any;
  roleId!: number;
  isLogged!: number;
  credentialUsername!: string;
  credentialPassword!: string;
  usuarioEncontrado: any;
  contraseniaDesencriptada!: string;


  constructor(private alertCtrl: AlertController,
    private navCtrl: NavController, private loadingCtrl: LoadingController,
    private authService: AuthClientesService) {}


  ngOnInit() {

  }

  /** Para volver al menú de inicio cuando cancelamos el iniciar sesión con el administrador */
  backToMenu() {
    this.navCtrl.navigateForward('/inicio');
  }


  /** Para las validaciones de iniciar sesión */
  async iniciarSesion() {
    if (this.user.valid) {
      this.datas = this.user.value;
      this.username = this.datas.username;
      this.password = this.datas.password;

      // Obtenemos los usuarios al intentar iniciar sesión (sin autenticación ni autorización)
      this.listaUsuarios = await this.authService.obtenerUsuarios();
      this.users = this.listaUsuarios.success;

      for (let indice = 0; indice < this.users.length; indice++) {
        if(this.users[indice].username === this.username) {
          this.id = this.users[indice].id;
          this.credentialUsername = this.users[indice].username;
          this.credentialPassword = this.users[indice].password;
          this.roleId = this.users[indice].role_id;
          this.isLogged = this.users[indice].is_logged;
        }
      }

      // Desencriptamos contraseña
      this.contraseniaDesencriptada = Buffer.from(this.credentialPassword, 'base64').toString('binary');
      this.usuarioEncontrado = this.users.find((user: { username: string; }) => user.username === this.username);

      /** Validamos si el usuario está contemplado o no en la tienda */
      if (this.usuarioEncontrado) {

        /** Validamos si las credenciales de usuario están correctas  */
        if (this.password !== this.contraseniaDesencriptada) {

          this.authService.setUsername(this.username);// para establecer el nombre de usuario actual
          //this.authService.setIsLogged(this.username);

          /** Validamos que el usuario no haya iniciado sesión */
          if (this.isLogged == 0) {
              /** Validamos si el usuario que intenta iniciar sesión es administrador y/o cliente o no */
              if (this.roleId == 4) {

                await this.authService.login(this.username, this.password)
                .then(async data => {
                  this.usuarios = data;
                  this.datosUsuarios = this.usuarios.success;
                  this.token = this.datosUsuarios.token;
                });

                this.clienteLogueado(this.username);
                //localStorage.setItem('token', this.token);
                this.navCtrl.navigateForward('/juegos', this.dataUsername);
              }
              else if (this.roleId == 1) {
                // El administrador si nos deja iniciar sesión

                await this.authService.login(this.username, this.password)
                .then(async data => {
                  this.usuarios = data;
                  this.datosUsuarios = this.usuarios.success;
                  this.token = this.datosUsuarios.token;
                });

                this.adminLogueado(this.username);
                this.navCtrl.navigateForward('/juegos', this.dataUsername);
              }
              else if (this.roleId == 2) {
                this.mensajeAlertaContable(this.username);
                this.navCtrl.navigateForward('/login');
              }
              else if (this.roleId == 3) {
                this.mensajeAlertaMozo(this.username);
                this.navCtrl.navigateForward('/login');
              }
          }
          else {
            this.alertUsuarioLogin(this.username);// para indicar que ya ha iniciado sesión
            this.navCtrl.navigateForward('/login');
          }
        }
        else {
          this.errorContrasenia(this.username);
          this.navCtrl.navigateForward('/login');
        }
      }
      else {
          this.usuarioNoRegistrado(this.username);
          this.navCtrl.navigateForward('/login');
      }
    }
    else {
      this.mensaje = "Error al iniciar sesión con el cliente";
      console.error(this.mensaje);
      this.alertErrorCliente(this.mensaje);
    }
  }


  /** Para cuando el cliente ha iniciado sesión éxitosamente */
  async clienteLogueado(username: string) {
    const cliente = await this.alertCtrl.create({
      header: 'Mensaje para el cliente',
      cssClass: 'loginCss',
      message: '<strong>'+username+' ha iniciado sesión correctamente.</strong>',
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

  /** Para cuando el cliente ha iniciado sesión éxitosamente */
  async alertUsuarioLogin(username: string) {
    const logged = await this.alertCtrl.create({
      header: 'Mensaje para el cliente',
      cssClass: 'loginCss',
      message: '<strong>'+username+' ya ha iniciado sesión.</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await logged.present();
  }


  async cargarUsuario() {

    const loadingUser = await this.loadingCtrl.create({
      message: 'Cargando aplicación...',
      duration: 700
    });
    await loadingUser.present();

    const { role, data } = await loadingUser.onDidDismiss();

    this.iniciarSesion();// después de cargar el usuario que se quiera loguear
  }


  /** ---------- Mensajes de alerta para usuarios que no están permitidos iniciar sesión -------- */
  async adminLogueado(username: string) {
    const admin = await this.alertCtrl.create({
      header: 'Mensaje de la tienda',
      cssClass: 'loginCss',
      message: '<strong>El administrador '+username+' ha iniciado sesión correctamente.</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await admin.present();
  }

  async mensajeAlertaContable(username: string) {
    const contable = await this.alertCtrl.create({
      header: 'Mensaje de la tienda',
      cssClass: 'loginCss',
      message: '<strong>No puede iniciar sesión con su usuario contable '+username+'.</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await contable.present();
  }

  async mensajeAlertaMozo(username: string) {
    const mozo = await this.alertCtrl.create({
      header: 'Mensaje de la tienda',
      cssClass: 'loginCss',
      message: '<strong>No puede iniciar sesión con su usuario mozo de almacén '+username+'.</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await mozo.present();
  }


  async alertErrorCliente(mensajeError: string) {
    const errorCliente = await this.alertCtrl.create({
      header: 'Mensaje para el cliente',
      cssClass: 'loginCss',
      message: '<strong>'+mensajeError+'</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => { }
        }
      ]
    });
    await errorCliente.present();
  }


  /** Para credenciales erróneas y usuarios no registrados */
  async errorContrasenia(username: string) {
    const credencial = await this.alertCtrl.create({
      header: 'LOGIN',
      cssClass: 'loginCss',
      message: '<strong>Error al introducir la contraseña '+username+'</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => {
          }
        }
      ]
    });
    await credencial.present();
  }

  async usuarioNoRegistrado(username: string) {
    const notValid = await this.alertCtrl.create({
      header: 'LOGIN',
      cssClass: 'loginCss',
      message: '<strong>Usuario '+username+' no registrado en la tienda Landgame</strong>',
      buttons: [
        {
          text: 'Aceptar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: (valid) => {
          }
        }
      ]
    });
    await notValid.present();
  }
}
