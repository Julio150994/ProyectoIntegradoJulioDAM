import { Component, OnInit } from '@angular/core';
import { LoadingController, AlertController, NavController } from '@ionic/angular';
import { AuthClientesService } from '../../services/auth-clientes.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../environments/environment.prod';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage implements OnInit {
  apiUrl = environment.landgameService;
  cliente: any;
  clientes: any;
  tok: any;
  token: any;
  validationForm: any;
  txtContrasenia!: string;


  /** Para visualizar el formulario de registro de clientes */
  formularioCliente = new FormGroup({
    nombre: new FormControl('', [Validators.required]),
    apellidos: new FormControl('', [Validators.required]),
    email: new FormControl('', [Validators.required, Validators.email]),
    username: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
    c_password: new FormControl('',[Validators.required])
  });

  constructor(private navCtrl: NavController, private alertCtrl: AlertController,
    private authService: AuthClientesService, private httpCliente: HttpClient) { }


  ngOnInit() {

  }

  /** Para volver al menú de inicio cuando cancelamos el iniciar sesión con el administrador */
  backToMenu() {
    this.navCtrl.navigateForward('/inicio');
  }

  /** Para registrar el cliente con mensaje de confirmación en gmail  */
  async registrarCliente() {
    this.validationForm = this.formularioCliente.value;

    if (this.validationForm.password === this.validationForm.c_password) {
      await this.authService.register(this.validationForm.nombre, this.validationForm.apellidos,
          this.validationForm.email, this.validationForm.username, this.validationForm.password,
          this.validationForm.c_password)
          .then(data => {
              
          });
    }
    else {
      this.txtContrasenia = 'Las contraseñas introducidas deben coincidir';
      this.alertContrasenias(this.txtContrasenia);
    }
  }


  async alertContrasenias(txtContrasenia: string) {
    const password = await this.alertCtrl.create({
      header: 'Mensaje de formulario de registro',
      cssClass: 'registerCss',
      message: '<strong>'+txtContrasenia+'</strong>',
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
    await password.present();
  }

  async clienteRegistrado(username: string) {
    const registrado = await this.alertCtrl.create({
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

}
