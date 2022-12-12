import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BuscadorPipe } from './buscador.pipe';
import { JuegosPipe } from './juegos.pipe';



@NgModule({
  declarations: [
    BuscadorPipe,
    JuegosPipe
  ],
  imports: [
    CommonModule
  ],
  exports: [
    BuscadorPipe,
    JuegosPipe
  ]
})
export class PipesModule { }
