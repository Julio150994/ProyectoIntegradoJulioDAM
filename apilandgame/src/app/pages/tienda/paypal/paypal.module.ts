import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PaypalPageRoutingModule } from './paypal-routing.module';

import { PaypalPage } from './paypal.page';
import { PipesModule } from '../../../pipes/pipes.module';


@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PaypalPageRoutingModule,
    ReactiveFormsModule,
    PipesModule
  ],
  declarations: [PaypalPage]
})
export class PaypalPageModule {}
