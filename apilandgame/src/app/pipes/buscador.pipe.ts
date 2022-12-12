import { Pipe, PipeTransform } from '@angular/core';
import { LoadingController } from '@ionic/angular';

@Pipe({
  name: 'buscador'
})
export class BuscadorPipe implements PipeTransform {
  constructor(private loadingCtrl: LoadingController){}

  /** Función para poder buscar por nombre de juego */
  transform(juegos: any[], nombre:string): any[] {
    if (!juegos || !nombre) {
      return juegos;
    }
    nombre = nombre.toUpperCase();
    return juegos.filter(juego => juego.nombre.toUpperCase().includes(nombre));
  }

  async cargandoBusqueda() {
    const loading = await this.loadingCtrl.create({
      message: 'Cargando buscador...',
      duration: 600
    });
    await loading.present();
  }

}
