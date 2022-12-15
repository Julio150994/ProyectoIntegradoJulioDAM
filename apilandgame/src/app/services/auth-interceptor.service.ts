import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent, HttpErrorResponse } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Router } from '@angular/router';


@Injectable({
  providedIn: 'root'
})
export class AuthInterceptorService {

  constructor(
    private router: Router
  ) {}


  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

    //const token: string = localStorage.getItem('token');
    const token = localStorage.getItem('token');

    let request = req;

    if (token) {
      const headers = req.clone({
        headers: req.headers.set("Authorization", `Bearer ${ token }`)
          .set('Cliente', 'landgame')
      });

      return next.handle(headers);
    }



    return next.handle(request).pipe(
      catchError((error: HttpErrorResponse) => {

        if (error.status === 401) {
          this.router.navigateByUrl('/login');
        }
        else if(error.status === 403) {
          this.router.navigateByUrl('/login');
        }
        else if(error.status === 404) {
          this.router.navigateByUrl('/login');
        }

        return throwError( error );

      })
    );
  }

}
