import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';


@Injectable({
  providedIn: 'root'
})
export class TiendaService {
  apiUrl = environment.landgameService;
  user: any;
  juegos: any;
  mensajeJuegos!: string;
  mensajeJuego!: string;
  idJuego!: number;
  juego: any;// para el juego seleccionado
  encontrado: any;
  juegoId: any;// para obtener el id seleccionado
  cantidad!: number;
  precioUnitario: any;


  constructor(private httpCliente: HttpClient) { }

  /** ------------ Servicio para la tienda móvil de Landgame -------------- */


  mostrarJuegos(token: any) {
    return new Promise(res => {
      this.httpCliente.get<any>(this.apiUrl+'/juegos', {
        headers: new HttpHeaders().set('Authorization', 'Bearer '+ token)
      }).subscribe(data => {
        console.log(data);

        if (data == null) {
          this.mensajeJuegos = 'No se han encontrado juegos en la tienda'
        }
        else {
          this.juegos = data;
          res(data);
        }
      }, error => {
        console.error('Error al mostrar los juegos '+error);
      });
    });
  }

  obtenerJuego(idJuego: number, token: any) {
    return new Promise(res => {
      this.httpCliente.get<any>(this.apiUrl+'/juego/'+idJuego, {
        headers: new HttpHeaders().set('Authorization', 'Bearer '+ token)
      }).subscribe(data => {
        console.log(data);
        this.encontrado = data;
        this.juego = this.encontrado.success;
        res(data);
      }, error => {
        console.log('Error al mostrar el juego '+error);
      });
    });
  }


  /** Establecemos y obtenemos el id de nuestro juego seleccionado */
  public setIdJuego(id: number){
    this.juegoId = id;
  }

  public getIdJuego() {
    return this.juegoId;
  }


  /** Establecemos y obtenemos cantidad y precio unitario */

  public setCantidad(cantidad: number){
    this.cantidad = cantidad;
  }

  public getCantidad() {
    return this.cantidad;
  }


  public setPrecio(precioUnitario: any){
    this.precioUnitario = precioUnitario;
  }

  public getPrecio() {
    return this.precioUnitario;
  }
}
