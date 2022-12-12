import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CompraPageRoutingModule } from './compra-routing.module';

import { CompraPage } from './compra.page';
import { PipesModule } from '../../../pipes/pipes.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CompraPageRoutingModule,
    ReactiveFormsModule,
    PipesModule
  ],
  declarations: [CompraPage]
})
export class CompraPageModule {}
