import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'inicio',
    loadChildren: () => import('./pages/inicio/inicio.module').then( m => m.InicioPageModule)
  },

  {
    path: '',
    redirectTo: 'inicio',
    pathMatch: 'full'
  },

  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'juegos',
    loadChildren: () => import('./pages/juegos/juegos.module').then( m => m.JuegosPageModule)
  },
  {
    path: 'carrito',
    loadChildren: () => import('./pages/tienda/carrito/carrito.module').then( m => m.CarritoPageModule)
  },
  {
    path: 'compra',
    loadChildren: () => import('./pages/tienda/compra/compra.module').then( m => m.CompraPageModule)
  },
  {
    path: 'paypal',
    loadChildren: () => import('./pages/tienda/paypal/paypal.module').then( m => m.PaypalPageModule)
  },
  {
    path: 'register',
    loadChildren: () => import('./pages/register/register.module').then( m => m.RegisterPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
